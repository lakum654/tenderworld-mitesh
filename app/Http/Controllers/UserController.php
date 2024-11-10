<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data = [
            'moduleName' => "Users",
            'view'       => 'admin.users.',
            'route'      => 'users'
        ];
    }

    public function index()
    {
        return view($this->data['view'] . 'index', $this->data);
    }

    public function getData()
    {
        $data = User::where('is_admin', 0)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                // $editUrl = route('users.edit', encrypt($row->id));
                $deleteUrl = route('users.delete', encrypt($row->id));
                $btn = '';
                // $btn .= '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm" style="margin-left:5px;"><i class="fa fa-pencil"> </i> Edit</a>';


                $btn .= '<a href="' . $deleteUrl . '" class="edit btn btn-danger btn-sm delete" style="margin-left:4px;margin-top:1px;"> <i class="fa fa-trash" /> </i> Delete</a>';
                return $btn;
            })

            ->editColumn('created_at', function ($row) {
                return date('d-m-Y H:i:s', strtotime($row->created_at));
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        return view($this->view . 'form', compact('moduleName'));
    }

    public function store(Request $request)
    {
        $user = new User();

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        //$user->status = $request->status;
        $user->save();

        return redirect($this->route);
    }

    public function destroy($id)
    {
        User::find(decrypt($id))->delete();


        Helper::successMsg('delete', 'User');
        return redirect(route($this->data['route'] . '.index'));
    }
}
