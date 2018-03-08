<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use App\WarehouseStock;
use App\LogWarehouseStock;
use App\Specification;
use Auth;
use AWS;

class WarehouseController extends Controller
{
    public function index(){
    if(Auth::user()->role !=1)
      abort('404');
      $categories = Category::get();
      $total = warehouseStock::sum('amount');
      foreach ($categories as $key => $category) {
        $subcategories = SubCategory::where('category_id',$category->id)->pluck('id')->toArray();
        $categories[$key]->stock = warehouseStock::whereIn('subcategory_id',$subcategories)->where('qty','!=',0)->get();
        $categories[$key]->amount = warehouseStock::whereIn('subcategory_id',$subcategories)->sum('amount');
      }
    	return view('warehouseStock',compact('categories','total'));
    }

    public function inventory(){
        $categories = SubCategory::get();
        $cats = Category::get();
        $title = "inventory";
        return view('warehouseInventory', compact('categories','title','cats'));    	
    }

    public function save(Request $request){
        $specifications = $request->specifications;
        $quantities = $request->quantity;
        $costings = $request->costing;
        $amounts = $request->amount;
        $purchased_by = $request->purchased_by;
        $recieved_by = $request->recieved_by;
        $dates = $request->date;
    		$comments = $request->comment;
    		foreach ($specifications as $key => $specification) {
     			$specification = Specification::where('id',$specifications[$key])->get();
     			if(count($specification) == 0)
     				continue;
          // $stocks = warehouseStock::where('subcategory_id',$categories[$key])->where('rate',$costings[$key])->get();
          // if(count($stocks)){
          //   $stock = $stocks[0];
          //   $stock->qty += $quantities[$key];
          //   $stock->amount += $costings[$key] * $quantities[$key];
          //   $stock->date = $dates[$key];
          //   $stock->comment = $comments[$key];
          //   $stock->user_id = Auth::user()->id;
          //   $stock->save();
          // }else{
       			// $stock = new WarehouseStock;
       			// $stock->subcategory_id = $categories[$key];
       			// $stock->rate = $costings[$key];
       			// $stock->qty = $quantities[$key];
       			// $stock->amount = $costings[$key] * $quantities[$key];
       			// $stock->comment = $comments[$key];
       			// $stock->date = $dates[$key];
       			// $stock->user_id = Auth::user()->id;
       			// $stock->save();
          // }
          $stock = new WarehouseStock;
          $stock->specification_id = $specifications[$key];
          $stock->rate = $costings[$key];
          $stock->qty = $quantities[$key];
          $stock->amount = $costings[$key] * $quantities[$key];
          $stock->purchased_by = $purchased_by[$key];
          $stock->recieved_by = $recieved_by[$key];
          $stock->comment = $comments[$key];
          $stock->date = $dates[$key];
          $stock->user_id = Auth::user()->id;
          $stock->save();

     		}

        $mobiles = [9654379609,9235553838,9582269794,9311044634];
        foreach ($mobiles as $mobile) {
                $sns = AWS::createClient('sns');
                $args = array();
                $args['SMSType'] = "transactional";
                $args['SenderID'] = "anurag";
                $args['Message'] = "Hi Admin, \n \nThe warehouse entries have been changed by ".Auth::user()->name.", Please have a look !";
                $args['PhoneNumber'] = "+91-". $mobile;
                $result = $sns->publish($args);
            }
   		return redirect('/warehouseStock');
    }
}
