<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;

class CategoryController extends Controller
{
    
    public function getSubCategory(Request $request){
        $category_id = $request->category;
        $c = $request->c;
        $subcategories = SubCategory::where('category_id',$category_id)->get();
        return [$subcategories,$c];       
    }
}
