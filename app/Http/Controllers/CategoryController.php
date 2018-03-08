<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\WarehouseStock;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    
    public function getSubCategory(Request $request){
        $category_id = $request->category;
        $c = $request->c;
        $subcategories = SubCategory::where('category_id',$category_id)->get();
        return [$subcategories,$c];       
    }
    
    public function getSubCategoryRates(Request $request){
        $subcategory_id = $request->subcategory;
        $c = $request->c;
        $rates = WarehouseStock::where('subcategory_id',$subcategory_id)->where('qty','>','0')->get();
        return [$rates,$c];       
    }
    
    public function getmaxquantity(Request $request){
        $subcategory_id = $request->subcategory;
        $costing = $request->costing;
        $c = $request->c;
        $rates = WarehouseStock::where('subcategory_id',$subcategory_id)->where('rate',$costing)->get();
        return [$rates[0]->qty,$c];       
    }

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
        return view('category',compact('categories'));
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
            $category = new Category;
            $category->category = $request->category;
            $category->save();
            return redirect('/category');
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
    }
}
