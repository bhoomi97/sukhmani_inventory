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

	public function save(Request $request){
		$categories = $request->subcategories;
		$sites = $request->site;
		$costings = $request->costing;
		$quantities = $request->quantity;
		$amounts = $request->amount;
		$comments = $request->comment;         
		$dates = $request->date;
		$errors = [];
		return;
		foreach ($categories as $key => $category) {
			$SubCategory = SubCategory::where('id',$categories[$key])->get();
			if(count($SubCategory) == 0)
				continue;
			$stocks = warehouseStock::where('subcategory_id',$categories[$key])->where('rate',$costings[$key])->get();
			if(count($stocks)==0){
				continue;
			}else{
				$stock = $stocks[0];
				if($quantities[$key]>$stock->qty){
					array_push($errors, [$SubCategory[0]->subcategory,$quantities[$key]]);
					continue;
				}
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
			$stock = new LogSiteStock;
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
			$args['Message'] = "Hi Admin, \n \nThe items have been moved to Sites. Please have a look !";
			$args['PhoneNumber'] = "+91-". $mobile;
			$result = $sns->publish($args);
		}
		return redirect('/warehouseStock');
	}

}
