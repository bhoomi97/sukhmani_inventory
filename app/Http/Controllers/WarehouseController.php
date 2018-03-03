<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;

class WarehouseController extends Controller
{
    public function index(){
    	return view('warehouseStock');
    }

    public function inventory(){
        $categories = SubCategory::get();
        $cats = Category::get();
        $title = "inventory";
        return view('warehouseInventory', compact('categories','title','cats'));    	
    }
}
