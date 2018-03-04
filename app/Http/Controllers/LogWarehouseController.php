<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogWarehouseStock;
use Auth;

class LogWarehouseController extends Controller
{
    public function index(){
    	if(Auth::user(0->role!=1))
    		abort('404');
    	$stocks = LogWarehouseStock::with('subcategory')->with('user')->paginate(50);
    	return view('logwarehousestock',compact('stocks'));
    }
}
