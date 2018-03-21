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
    	return view('warehouseStock');
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


        public function warehouseStock(Request $request)
        {
          $columns = array( 
                              0 =>'category', 
                              1 =>'subcategory',
                              2 => 'vendor',
                              3 => 'specification',
                              4 => 'rate',
                              5 => 'qty',
                              6 => 'amount',
                              7 => 'purchased_by',
                              8 => 'recieved_by',
                              9 => 'comment',
                              10 => 'date'
                          );
 
          $totalData = WarehouseStock::count();
              
          $totalFiltered = $totalData; 

          $limit = $request->length;
          $start = $request->start;
          $order = $columns[($request->order)['0']['column']];
          $dir = ($request->order)['0']['dir'];

          if(empty($request->search['value']))
          {            
              $stocks = WarehouseStock::join('specifications','specifications.id','=','warehouse_stock.specification_id')
                          ->join('vendors','vendors.id','=','specifications.vendor_id')
                          ->join('subcategories','subcategories.id','=','vendors.subcategory_id')
                          ->join('categories','categories.id','=','subcategories.category_id')
                           ->offset($start)
                           ->limit($limit)
                           ->orderBy($order,$dir)
                           ->get();

              $totalFiltered = WarehouseStock::join('specifications','specifications.id','=','warehouse_stock.specification_id')
                          ->join('vendors','vendors.id','=','specifications.vendor_id')
                          ->join('subcategories','subcategories.id','=','vendors.subcategory_id')
                          ->join('categories','categories.id','=','subcategories.category_id')
                           ->orderBy($order,$dir)
                           ->count();

          }
          else {
              $search = Input::get('search.value');

              $emps =  Employees::join('zones','zones.zoneid','=','employees.zoneid')
                           ->leftJoin('empDesignations as ed','ed.edid','=','employees.edid')
                              ->leftJoin('employees as e','e.euid','=','employees.reportingToEuid')
                              ->where('ed.level','!=',1)
                              ->where(function($q) use ($search){
                                  $q->where('e.cid',Auth::user()->cid)
                                    ->orWhere('employees.reportingToEuid',null);
                                })
                              ->where(function($q) use ($search){
                                  $q->where('employees.euid','LIKE',"%{$search}%")
                                    ->orWhere('employees.name', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.username', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.phone1', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.phone2', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.email1', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.email2', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.headquarter', 'LIKE',"%{$search}%")
                                    ->orWhere('ed.designation', 'LIKE',"%{$search}%")
                                    ->orWhere('e.name', 'LIKE',"%{$search}%")
                                    ->orWhere('zones.zone', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.state', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.status', 'LIKE',"%{$search}%");
                                })
                              ->where('employees.cid',Auth::user()->cid)
                              ->select('employees.*','ed.designation','e.name as reportingTo','zones.zone')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order,$dir)
                              ->get();

              $totalFiltered =  Employees::join('zones','zones.zoneid','=','employees.zoneid')
                           ->leftJoin('empDesignations as ed','ed.edid','=','employees.edid')
                              ->leftJoin('employees as e','e.euid','=','employees.reportingToEuid')
                              ->where('ed.level','!=',1)
                              ->where(function($q) {
                                  $q->where('e.cid',Auth::user()->cid)
                                    ->orWhere('employees.reportingToEuid',null);
                                })
                              ->where(function($q) use ($search){
                                  $q->where('employees.euid','LIKE',"%{$search}%")
                                    ->orWhere('employees.name', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.username', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.phone1', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.phone2', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.email1', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.email2', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.headquarter', 'LIKE',"%{$search}%")
                                    ->orWhere('ed.designation', 'LIKE',"%{$search}%")
                                    ->orWhere('e.name', 'LIKE',"%{$search}%")
                                    ->orWhere('zones.zone', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.state', 'LIKE',"%{$search}%")
                                    ->orWhere('employees.status', 'LIKE',"%{$search}%");
                                })                              
                              ->where('employees.cid',Auth::user()->cid)
                              ->select('employees.*','ed.designation','e.name as reportingTo','zones.zone')
                              ->orderBy($order,$dir)
                              ->count();

          }
          $data = array();
          if(!empty($stocks))
          {
              foreach ($stocks as $stock)
              {
                                     
                  $nestedData['category'] = $stock->category;
                  $nestedData['subcategory'] = $stock->subcategory;
                  $nestedData['vendor'] = $stock->vendor;
                  $nestedData['specification'] = $stock->specification;
                  $nestedData['rate'] = $stock->rate;
                  $nestedData['qty'] = $stock->qty;
                  $nestedData['amount'] = $stock->amount;
                  $nestedData['purchased_by'] = $stock->purchased_by;
                  $nestedData['recieved_by'] = $stock->recieved_by;
                  $nestedData['comment'] = $stock->comment;
                  $nestedData['date'] = $stock->date;
                  $data[] = $nestedData;

              }
          }
            
          $json_data = array(
                      "draw"            => intval($request->draw),  
                      "recordsTotal"    => intval($totalData),  
                      "recordsFiltered" => intval($totalFiltered), 
                      "data"            => $data   
                      );
              
          echo json_encode($json_data); 
        
        }                  
}
