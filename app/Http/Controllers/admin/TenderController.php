<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Imports\TenderImport;
use App\Models\City;
use App\Models\State;
use App\Models\Tender;
use App\Models\TenderCategory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function getData(Request $request)
    {
        $tenders = Tender::with('category');

        if ($request->start_date || $request->end_date) {
            if ($request->start_date && $request->end_date) {
                $start = date('Y-m-d', strtotime($request->start_date));
                $end = date('Y-m-d', strtotime($request->end_date));
                Log::info([$start,$end]);
                $tenders->whereDate('start_date', '>=', $start)
                    ->whereDate('end_date', '<=', $end);
            } elseif ($request->start_date) {
                $start = date('Y-m-d', strtotime($request->start_date));
                $tenders->whereDate('start_date', $start);
                Log::info([$start]);
            } elseif ($request->end_date) {
                $end = date('Y-m-d', strtotime($request->end_date));
                $tenders->whereDate('end_date',$end);
                Log::info([$end]);
            }
        }

        $tenders->orderBy('id','desc');
        return DataTables::eloquent($tenders)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('tender.edit', encrypt($row->id));
                $deleteUrl = route('tender.delete', encrypt($row->id));
                $btn = '';
                $btn .= '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm" style="margin-left:5px;"><i class="fa fa-pencil"> </i> Edit</a>';


                $btn .= '<a href="' . $deleteUrl . '" class="edit btn btn-danger btn-sm delete" style="margin-left:4px;margin-top:1px;"> <i class="fa fa-trash" /> </i> Delete</a>';
                return $btn;
            })

            ->addColumn('checkbox', function ($row) {
                return "<input type='checkbox' class='checkbox' value='" . $row->id . "'/>";
            })

            ->editColumn('work', function ($row) {
                return strip_tags(Str::limit($row->work, 150));
            })

            ->editColumn('start_date', function ($row) {
                return date('d-m-Y', strtotime($row->start_date));
            })

            ->editColumn('end_date', function ($row) {
                return date('d-m-Y', strtotime($row->end_date));
            })

            ->editColumn('tender_open', function ($row) {
                return date('d-m-Y', strtotime($row->tender_open));
            })

            ->rawColumns(['action', 'checkbox'])
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
            "Category Name",
            "Document Link",
            "Qty",
            "Tender Type"
        ];

        // Validate the file header
        $headerErrors = $this->validateHeader($rows[0][0], $expectedHeader);
        if (!empty($headerErrors)) {
            $errorColumns = implode(', ', $headerErrors);
            Helper::successMsg('error', "Tender file is not valid. Please correct the following columns: $errorColumns.");
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

            if (isset($row[14])) {
                $category = TenderCategory::where('name', trim($row[14]))->first();
                if ($category == null) {
                    $category = TenderCategory::create(['name' => trim($row[14])]);
                }
            }

            if (isset($row[4])) {
                $state = State::where('name', trim($row[4]))->first();
                if ($state == null) {
                    $state = State::create(['name' => trim($row[4])]);
                }
            }

            if (isset($row[3])) {
                $state = City::where('name', trim($row[3]))->first();
                if ($state == null) {
                    $state = City::create(['name' => trim($row[3])]);
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
                'category_id' => $row[14],
                'document_link' => $row[15],
                'qty' => $row[16],
                'tender_type' => $row[17]
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

    public function edit($id)
    {
        $this->data['tender'] = Tender::find(decrypt($id));
        $this->data['categories'] = TenderCategory::all();
        return view($this->data['view'] . '_form', $this->data);
    }

    public function update(Request $request, $id)
    {
        // Find the tender by ID
        $tender = Tender::findOrFail($id);

        // Validate the request data
        $request->validate([
            'category_id' => 'required|exists:tender_categories,id',
            'bid_no' => 'required|string',
            'work' => 'required|string',
            'tender_id' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'department' => 'required|string',
            'emd_exemption' => 'nullable|string',
            'mse_exemption' => 'nullable|string',
            'tender_value' => 'nullable|string',
            'tender_emd' => 'nullable|string',
            'tender_fee' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'tender_open' => 'nullable|date',
            'document_link' => 'nullable',
            'qty' => 'nullable',
            'tender_type' => 'nullable'
        ]);


        // dd($request->all());
        // Update the tender with the validated data
        $tender->update([
            'category_id' => $request->category_id,
            'bid_no' => $request->bid_no,
            'work' => $request->work,
            'tender_id' => $request->tender_id,
            'city' => $request->city,
            'state' => $request->state,
            'department' => $request->department,
            'emd_exemption' => $request->emd_exemption,
            'mse_exemption' => $request->mse_exemption,
            'tender_value' => $request->tender_value,
            'tender_emd' => $request->tender_emd,
            'tender_fee' => $request->tender_fee,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'tender_open' => $request->tender_open,
            'document_link' => $request->document_link,
            'qty' => $request->qty,
            'tender_type' => $request->tender_type
        ]);

        // Success message and redirect
        Helper::successMsg('custom', 'Tender updated successfully.');
        return redirect()->route('tender.index');
    }


    public function destroy($id)
    {
        Tender::find(decrypt($id))->delete();


        Helper::successMsg('delete', 'Tender');
        return redirect(route($this->data['route'] . '.index'));
    }

    public function bulkDestroy(Request $request)
    {
        try {
            $tender_ids = $request->tender_ids;
            Tender::whereIn('id', $tender_ids)->delete();
            return response()->json(['status' => true]);
        } catch (Exception $e) {
            return response()->json(['status' => false]);
        }
    }
}
