<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Tender;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $usersCount = User::count();
        $tendersCount = Tender::count();
        $contactCount = Contact::count();
        return view('admin.index',compact('usersCount','tendersCount','contactCount'));
    }
}
