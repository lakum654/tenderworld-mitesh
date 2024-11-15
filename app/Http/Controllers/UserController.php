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
                $approveUrl = route('users.approve', encrypt($row->id));
                $btn = '';
                // $btn .= '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm" style="margin-left:5px;"><i class="fa fa-pencil"> </i> Edit</a>';


                $btn .= '<a href="' . $deleteUrl . '" class="edit btn btn-danger btn-sm delete" style="margin-left:4px;margin-top:1px;"> <i class="fa fa-trash" /> </i> Delete</a>';
                if ($row->is_approved) {
                    // Show "Unapprove" button if already approved
                    $btn .= '<a href="' . $approveUrl . '" class="btn btn-danger btn-sm confirm-box" style="margin-left:4px;margin-top:1px;">
                                <i class="fa fa-times"></i> Unapprove
                             </a>';
                } else {
                    // Show "Approve" button if not approved
                    $btn .= '<a href="' . $approveUrl . '" class="btn btn-success btn-sm confirm-box" style="margin-left:4px;margin-top:1px;">
                                <i class="fa fa-check"></i> Approve
                             </a>';
                }
                return $btn;
            })

            ->editColumn('created_at', function ($row) {
                return date('d-m-Y H:i:s', strtotime($row->created_at));
            })

            ->addColumn('is_approved', function ($row) {
                return $row->is_approved
                    ? '<span class="badge badge-success">YES</span>'
                    : '<span class="badge badge-primary">NO</span>';
            })

            ->rawColumns(['action','is_approved'])
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

    public function approve($id) {
        $user = User::find(decrypt($id));

        if($user->is_approved) {
            $user->update(['is_approved' => false]);
            Helper::successMsg('custom', 'User Unapproved Successfully.');
        } else {
            $user->update(['is_approved' => true]);
            Helper::successMsg('custom', 'User Approved Successfully.');
        }

        return redirect(route($this->data['route'] . '.index'));
    }
}
