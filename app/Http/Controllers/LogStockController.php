<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogSiteStock;

class LogStockController extends Controller
{
    public function index(){
    	$stocks = LogSiteStock::with('subcategory')->with('user')->with('site')->paginate(50);
    	return view('logsitestock',compact('stocks'));
    }
}
