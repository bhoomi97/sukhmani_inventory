<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Vendor;
use App\Specification;
use Auth;

class VendorController extends Controller
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
        $categories = Category::get();
        $vendors = Vendor::get();
        foreach ($vendors as $key => $vendor) {
            $vendors[$key]->specs = Specification::where('vendor_id', $vendor->id)->get();
        }
        return view('vendor',compact('categories','vendors'));
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
        if(Auth::user()->role != 1)
            abort('404');
        $subcategory = $request->subcategory;
        $vend = $request->vendor;
        $specs_string = $request->specification;
        $vendor = new Vendor;
        $vendor->vendor = $vend;
        $vendor->subcategory_id = $subcategory;
        $vendor->save();

        $specs = explode(",", $specs_string);
        foreach ($specs as $spec ) {
            $sp = new Specification;
            $sp->specification = trim($spec);
            $sp->vendor_id = $vendor->id;
            $sp->save();
        }
        return redirect('/vendor');
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
