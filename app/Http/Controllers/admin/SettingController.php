<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data = [
            'moduleName' => "Setting",
            'view'       => 'admin.setting.',
            'route'      => 'setting'
        ];
    }

    // Display the profile edit form
    public function index()
    {
        return view($this->data['view'] . 'index', $this->data);
    }

    public function update(Request $request) {
        dd($request);
    }
}
