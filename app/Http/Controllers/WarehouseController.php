<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use App\WarehouseStock;
use Auth;

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

    public function save(Request $request){
        $categories = $request->subcategories;
        $quantities = $request->quantity;
        $costings = $request->costing;
        $amounts = $request->amount;
        $dates = $request->date;
		$comments = $request->comment;         
		foreach ($categories as $key => $category) {
   			$SubCategory = SubCategory::where('id',$categories[$key])->get();
   			if(count($SubCategory) == 0)
   				continue;
   			$stock = new WarehouseStock;
   			$stock->subcategory_id = $categories[$key];
   			$stock->rate = $costings[$key];
   			$stock->qty = $quantities[$key];
   			$stock->amount = $amounts[$key];
   			$stock->comment = $comments[$key];
   			$stock->date = $dates[$key];
   			$stock->user_id = Auth::user()->id;
   			$stock->save();
   		}
   		return "Success";
    }
}
