<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Site;

class SiteStockController extends Controller
{
    public function inventory(){
        $categories = SubCategory::get();
        $cats = Category::get();
        $sites = Site::where('status',1)->get();
        $title = "inventory";
        return view('siteInventory', compact('categories','title','cats','sites'));    	
    }

}
