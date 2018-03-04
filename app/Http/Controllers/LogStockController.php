<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogSiteStock;
use Auth;

class LogStockController extends Controller
{
    public function index(){
    	if(Auth::user(0->role!=1))
    		abort('404');
    	$stocks = LogSiteStock::with('subcategory')->with('user')->with('site')->paginate(50);
    	return view('logsitestock',compact('stocks'));
    }
}
