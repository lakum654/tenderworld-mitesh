<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Imports\TenderImport;
use App\Models\Tender;
use App\Models\TenderCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class TenderController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data = [
            'moduleName' => "Tender",
            'view'       => 'admin.tender.',
            'route'      => 'tender'
        ];
    }

    public function index()
    {
        return view($this->data['view'] . 'index', $this->data);
    }

    public function getData()
    {
        $data = Tender::with('category')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('tender.edit', encrypt($row->id));
                $deleteUrl = route('tender.delete', encrypt($row->id));
                $btn = '';
                $btn .= '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm" style="margin-left:5px;"><i class="fa fa-pencil"> </i> Edit</a>';


                $btn .= '<a href="' . $deleteUrl . '" class="edit btn btn-danger btn-sm" style="margin-left:4px;margin-top:1px;"> <i class="fa fa-trash" /> </i> Delete</a>';
                return $btn;
            })

            ->editColumn('work', function ($row) {
                return strip_tags(Str::limit($row->work, 150));
            })

            ->editColumn('start_date', function ($row) {
                return date('d-m-Y',strtotime($row->start_date));
            })

            ->editColumn('end_date', function ($row) {
                return date('d-m-Y',strtotime($row->start_date));
            })

            ->editColumn('tender_open', function ($row) {
                return date('d-m-Y',strtotime($row->start_date));
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view($this->data['view'] . 'form', $this->data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        // Read the rows from the Excel file
        $rows = Excel::toArray(new TenderImport, $request->file('file'));

        // Define the expected header format
        $expectedHeader = [
            "Bid No",
            "Work",
            "Tender Id",
            "City",
            "State",
            "Department",
            "Emd Exemption",
            "MSE Exemption",
            "Tender Value",
            "Tender Emd",
            "Tender Fee",
            "Start date",
            "End date",
            "Tender Open",
            "Category Name"
        ];

        // Validate the file header
        $headerErrors = $this->validateHeader($rows[0][0], $expectedHeader);
        if (!empty($headerErrors)) {
            $errorColumns = implode(', ', $headerErrors);
            Helper::successMsg('custom', "Tender file is not valid. Please correct the following columns: $errorColumns.");
            return redirect()->back();
        }

        // Process data rows
        $data = [];
        foreach ($rows[0] as $key => $row) {
            // Skip header row
            if ($key == 0) {
                continue;
            }

            // Convert date fields if they are numeric (Excel serial format)
            $row[11] = isset($row[11]) && is_numeric($row[11]) ? $this->convertExcelDate($row[11]) : $row[11];
            $row[12] = isset($row[12]) && is_numeric($row[12]) ? $this->convertExcelDate($row[12]) : $row[12];
            $row[13] = isset($row[13]) && is_numeric($row[13]) ? $this->convertExcelDate($row[13]) : $row[13];

            if(isset($row[14])) {
                $category = TenderCategory::where('name',trim($row[14]))->first();
                if($category == null) {
                    $category = TenderCategory::create(['name' => trim($row[14])]);
                }
            }

            $row[14] = $category->id;
            // Map data to fields
            $data[] = [
                'bid_no' => $row[0],
                'work' => $row[1],
                'tender_id' => $row[2],
                'city' => $row[3],
                'state' => $row[4],
                'department' => $row[5],
                'emd_exemption' => $row[6],
                'mse_exemption' => $row[7],
                'tender_value' => $row[8],
                'tender_emd' => $row[9],
                'tender_fee' => $row[10],
                'start_date' => $row[11],
                'end_date' => $row[12],
                'tender_open' => $row[13],
                'category_id' => $row[14]
            ];
        }

        // Bulk insert to improve performance
        Tender::insert($data);

        Helper::successMsg('custom', "Tender File Imported Successfully.");
        return back();
    }

    // Helper function to validate header with detailed error reporting
    private function validateHeader(array $header, array $expectedHeader)
    {
        $header = array_map('trim', $header); // Trim all header elements
        $errors = [];

        foreach ($expectedHeader as $index => $expectedColumn) {
            if (!isset($header[$index]) || $header[$index] !== $expectedColumn) {
                $errors[] = $expectedColumn; // Collect the name of the expected column if it does not match
            }
        }

        return $errors; // Return an array of mismatched columns
    }

    // Helper function to convert Excel date serial numbers to a formatted date
    private function convertExcelDate($excelDate)
    {
        return Carbon::instance(Date::excelToDateTimeObject($excelDate))->format('Y-m-d');
    }

    public function destroy($id)
    {
        Tender::find(decrypt($id))->delete();


        Helper::successMsg('delete', 'Tender');
        return redirect(route($this->data['route'] . '.index'));
    }
}
