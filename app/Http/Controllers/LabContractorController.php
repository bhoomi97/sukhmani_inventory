<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LabSubcategories;
use App\LabContractor;
use Auth;

class LabContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role != 1)
            abort('404');
        $subcategories = LabSubcategories::get();
        foreach ($subcategories as $key => $subcategory) {
            $contractors = LabContractor::where('subcategory_id',$subcategory->id)->get();
            $subcategories[$key]->sub = $contractors;
        }
        return view('contractor',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role == 1){
            $contractor = new LabContractor;
            $contractor->subcategory_id = $request->subcategory;
            $contractor->contractor = $request->contractor;
            $contractor->save();
            return redirect('/labcontractor');
        }
        else{
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
