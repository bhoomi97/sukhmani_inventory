<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogWarehouseStock;

class LogWarehouseController extends Controller
{
    public function index(){
    	$stocks = LogWarehouseStock::with('subcategory')->with('user')->paginate(50);
    	return view('logwarehousestock',compact('stocks'));
    }
}
