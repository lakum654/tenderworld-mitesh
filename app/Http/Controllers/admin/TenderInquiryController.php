<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\TenderInquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TenderInquiryController extends Controller
{
    public $data = [];
    public function __construct()
    {
        $this->data = [
            'moduleName' => "Tender Inquiry",
            'view'       => 'admin.tender_inquiry.',
            'route'      => 'tender-inquiries'
        ];
    }

    public function index()
    {
        return view($this->data['view'].'index',$this->data);
    }


    public function getData()
    {
        $data = TenderInquiry::with('tender')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = "";
                $deleteUrl = route('tender-inquiries.delete', encrypt($row->id));
                $btn .= '<a href="' . $deleteUrl . '" class="edit btn btn-danger btn-sm delete" style="margin-left:5px;"> <i class="fa fa-trash" /> </i> Delete</a>';
                return $btn;
            })

            ->editColumn('created_at',function($row) {
                return date('d-m-Y H:i:m',strtotime($row->created_at));
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy($id)
    {
        TenderInquiry::find(decrypt($id))->delete();


        Helper::successMsg('delete', 'Tender Inquiry');
        return redirect(route($this->data['route'] . '.index'));
    }
}
