<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Contact;
use App\Models\State;
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
        $states = State::get();
        $cities = City::get();
        $tenderTypes = array_unique(array_filter(Tender::pluck('tender_type')->toArray()));
        return view('user.tender', compact('tenders','states','cities','tenderTypes'));
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
            // Split the input into an array of keywords
            $keywords = json_decode($request->input('keyword'), true);
            // dd($keywords);
            // Apply the `LIKE` condition for each keyword
            $query->where(function ($subQuery) use ($keywords) {
                foreach ($keywords as $keyword) {
                    // dd($keyword['value']);
                    $subQuery->orWhere('work', 'like', '%' . trim($keyword['value']) . '%')
                    ->orWhere('department','like','%' . trim($keyword['value']) . '%');
                }
            });
        }

        if ($request->has('department') && $request->input('department') != '') {
            $query->where('department', 'like', '%' . $request->input('department') . '%');
        }

        if ($request->has('state') && $request->input('state') != '' && $request->input('state') != 'Select State') {
            $query->where('state', $request->input('state'));
        }

        if ($request->has('city') && $request->input('city') != '' && $request->input('city') != 'Select City') {
            $query->where('city', $request->input('city'));
        }

        if ($request->has('tender_type') && $request->input('tender_type') != '' && $request->input('tender_type') != 'Select Type') {
            $query->where('tender_type', $request->input('tender_type'));
        }

        // Paginate the results (3 items per page)
        $tenders = $query->orderBy('id','desc')->paginate(10);

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

    public function tenderSearch()
    {
        $search = $_GET['query'];
        $tenders = Tender::where('work','like','%'.$search.'%')->paginate(10);
        $states = State::get();
        $cities = City::get();
        $tenderTypes = array_unique(array_filter(Tender::pluck('tender_type')->toArray()));
        return view('user.tender', compact('tenders','states','cities','tenderTypes'));
    }
}
