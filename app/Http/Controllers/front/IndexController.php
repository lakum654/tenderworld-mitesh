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
    public function contactStore(Request $request)
    {
        try {
            Contact::create([
                'name'    => $request->name,
                'email'   => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            session()->flash('success', 'Your message has been sent. Thank you!');
            return back();
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function tender()
    {
        $tenders = Tender::paginate(3);
        return view('user.tender', compact('tenders'));
    }

    public function fetchTenders(Request $request)
    {
        $query = Tender::query();

        // Apply filters
        if ($request->has('query') && $request->input('query') != '') {
            $query->where('work', 'like', '%' . $request->input('query') . '%');
        }

        if ($request->has('refNo') && $request->input('refNo') != '') {
            $query->where('tender_id', 'like', '%' . $request->input('refNo') . '%');
        }

        if ($request->has('keyword') && $request->input('keyword') != '') {
            $query->where('work', 'like', '%' . $request->input('keyword') . '%')
             ->orWhere('department', 'like', '%' . $request->input('keyword') . '%');
        }

        if ($request->has('state') && $request->input('state') != '' && $request->input('state') != 'Select State') {
            $query->where('state', $request->input('state'));
        }

        // Paginate the results (3 items per page)
        $tenders = $query->paginate(10);

        // Return JSON response with paginated data
        return response()->json($tenders);
    }



    public function tenderShow($id)
    {
        $tender = Tender::find($id);
        return view('user.tender-show', compact('tender'));
    }

    public function tenderInquiry(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        TenderInquiry::create($inputs);
        session()->flash('success', 'Your inquiry has been sent. Thank you!');
        return back();
    }

    public function tenderDownload($id)
    {
        return 'Tender Document Download Code Is Pendding';
    }
}
