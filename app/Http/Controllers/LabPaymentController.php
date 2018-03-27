<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LabSubcategories;
use App\Site;
use App\LabPayment;
use App\LabContractor;

class LabPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = LabSubcategories::get();
        $conts = LabContractor::where('subcategory_id',16)->get();
        $sites = Site::where('status',1)->get();
        return view('labPaymentCreate',compact('categories','sites','conts'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contractors = $request->contractors;
        $amounts = $request->amount;
        $sites = $request->sites;
        $dates = $request->date;
        $comments = $request->comment;
        foreach ($contractors as $key => $contractor) {
            if($sites[$key] == "all"){
                $siteslist = Site::where('status',1)->get();
                foreach ($siteslist as $sitelist) {
                    $payment = new LabPayment;
                    $payment->contractor_id = $contractor;
                    $payment->site_id = $sitelist->id;
                    $payment->amount = $amounts[$key];
                    $payment->date = $dates[$key];
                    $payment->comment = $comments[$key];
                    $payment->save();
                    // return $payment;
                }
            }else{
                $payment = new LabPayment;
                $payment->contractor_id = $contractor;
                $payment->site_id = $sites[$key];
                $payment->amount = $amounts[$key];
                $payment->date = $dates[$key];
                $payment->comment = $comments[$key];
                $payment->save();
            }
        }
        return redirect('/siteList');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = Site::where('id',$id)->first();
        $payments = LabPayment::where('site_id',$id)->with('contractor')->with('site')->with('contractor.subcategory')->get();
        return view('labPaymentShow',compact('payments','site'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function salary(Request $request){
        $contractor = $request->contractor;
        $amount = $request->amount;
        $comment = $request->comment;
        $date = $request->date;
        $sites = $request->site;
        foreach ($sites as $site) {
            $pay = new LabPayment;
            $pay->contractor_id = $contractor;
            $pay->amount = $amount/count($sites);
            $pay->comment = $comment;
            $pay->date = $date;
            $pay->site_id = $site;
            $pay->save();
        }
        return redirect('/siteList');
    }
}
