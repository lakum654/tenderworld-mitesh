<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Tender;
use App\Models\TenderInquiry;
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

    public function tenderShow($id) {
        $tender = Tender::find($id);
        return view('user.tender-show',compact('tender'));
    }

    public function tenderInquiry(Request $request) {
        $inputs = $request->all();
        unset($inputs['_token']);
        TenderInquiry::create($inputs);
        session()->flash('success','Your inquiry has been sent. Thank you!');
        return back();
    }
}
