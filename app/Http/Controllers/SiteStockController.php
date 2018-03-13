<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Site;
use App\SiteStock;
use App\LogSiteStock;
use App\WarehouseStock;
use App\Specification;
use Auth;
use AWS;
use Log;

class SiteStockController extends Controller
{
	public function inventory(){
		$categories = SubCategory::get();
		$cats = Category::get();
		$sites = Site::where('status',1)->get();
		$title = "inventory";
		$s = 0;
		return view('siteInventory', compact('categories','title','cats','sites','s'));    	
	}

	public function save(Request $request){
        $specifications = $request->specifications;
        $sites = $request->sites;
        $quantities = $request->quantity;
        $costings = $request->costings;
        $amounts = $request->amount;
        $delivered_to = $request->delivered_to;
        $delivered_by = $request->delivered_by;
        $dates = $request->date;
		$comments = $request->comment;
		$errors = [];
		foreach ($specifications as $key => $spec) {
			$spec1 = Specification::where('id',$specifications[$key])->get();
			if(count($spec1) == 0)
				continue;
			Log::info($spec);
			$stocks = WarehouseStock::where('specification_id',$specifications[$key])->where('rate',$costings[$key])->sum('qty');
			Log::info($costings[$key]);
				Log::info($stocks);
			if($quantities[$key] > $stocks){
				array_push($errors, [$spec1[0]->specification,$quantities[$key]]);
				continue;
			}
			$left_qty = $quantities[$key];
			while($left_qty>0){
				$stocks1 = WarehouseStock::where('specification_id',$specifications[$key])->where('rate',$costings[$key])->first();
				if($stocks1->qty <= $left_qty){
					$left_qty-=$stocks1->qty;
					$stocks1->delete();
					Log::info("#");
				}else{
					$q = $stocks1->qty - $left_qty;
					$stocks1->update(['qty' => $q]);
					Log::info("$");
					break;
				}
			}

			$stock = new SiteStock;
			$stock->site_id = $sites[$key];
			$stock->specification_id = $specifications[$key];
			$stock->rate = $costings[$key];
			$stock->qty = $quantities[$key];
			$stock->amount = $costings[$key] * $quantities[$key];
			$stock->comment = $comments[$key];
			$stock->date = $dates[$key];
			$stock->delivered_by = $delivered_by[$key];
			$stock->delivered_to = $delivered_to[$key];
			$stock->user_id = Auth::user()->id;
			$stock->save();
		}

		$mobiles = [9654379609,9235553838,9582269794,9311044634];
		foreach ($mobiles as $mobile) {
			$sns = AWS::createClient('sns');
			$args = array();
			$args['SMSType'] = "transactional";
			$args['SenderID'] = "anurag";
			$args['Message'] = "Hi Admin, \n \nThe items have been moved to Sites by ".Auth::user()->name.". Please have a look !";
			$args['PhoneNumber'] = "+91-". $mobile;
			$result = $sns->publish($args);
		}
		$s=1;
		return redirect('/siteInventory');
	}

}
