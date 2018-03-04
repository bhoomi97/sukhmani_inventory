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
        $rates = WarehouseStock::where('subcategory_id',$subcategory_id)->where('qty','>','0')->distinct('rate')->get();
        return [$rates,$c];       
    }

}
