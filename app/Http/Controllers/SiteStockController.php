<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Site;
use App\SiteStock;
use App\LogSiteStock;

class SiteStockController extends Controller
{
    public function inventory(){
        $categories = SubCategory::get();
        $cats = Category::get();
        $sites = Site::where('status',1)->get();
        $title = "inventory";
        return view('siteInventory', compact('categories','title','cats','sites'));    	
    }

    public function save(){
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
          $stocks = warehouseStock::where('subcategory_id',$categories[$key])->where('rate',$costings[$key])->get();
          if(count($stocks)){
            $stock = $stocks[0];
            $stock->qty += $quantities[$key];
            $stock->amount += $amounts[$key];
            $stock->date = $dates[$key];
            $stock->comment = $comments[$key];
            $stock->user_id = Auth::user()->id;
            $stock->save();
          }else{
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
          $stock = new LogWarehouseStock;
          $stock->subcategory_id = $categories[$key];
          $stock->rate = $costings[$key];
          $stock->qty = $quantities[$key];
          $stock->amount = $amounts[$key];
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
                $args['Message'] = "Hi Admin, \n \nThe warehouse entries have been changed, Please have a look !";
                $args['PhoneNumber'] = "+91-". $mobile;
                $result = $sns->publish($args);
            }
   		return redirect('/warehouseStock');
    }

}
