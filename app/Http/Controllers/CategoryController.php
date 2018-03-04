<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\WarehouseStock;

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

}
