<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Tender;
use Exception;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function contactStore(Request $request) {
        try {
            Contact::create([
                'name'    => $request->name,
                'email'   => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            session()->flash('success','Your message has been sent. Thank you!');
            return back();
        } catch(Exception $e) {
            session()->flash('error',$e->getMessage());
        }
    }

    public function tender() {
        $tenders = Tender::all();
        return view('user.tender',compact('tenders'));
    }
}
