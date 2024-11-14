<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public $data = [];
    public function __construct()
    {
        $this->data = [
            'moduleName' => "Contact",
            'view'       => 'admin.contact.',
            'route'      => 'contacts'
        ];
    }

    public function index()
    {
        return view($this->data['view'].'index',$this->data);
    }


    public function getData()
    {
        $data = Contact::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = "";
                $deleteUrl = route('contacts.delete', encrypt($row->id));
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
        Contact::find(decrypt($id))->delete();


        Helper::successMsg('delete', 'Contact');
        return redirect(route($this->data['route'] . '.index'));
    }
}
