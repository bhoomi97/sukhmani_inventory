<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WarehouseStock;
use App\Category;
use App\SubCategory;
use App\Site;
use App\SiteStock;
use Mail;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mail::send('email.notify',[], function($message){
        //     $message->to('himanshuagrawal1998@gmail.com')->from('himanshuagrawal1998@gmail.com', 'Sukhmani')->subject("Stock Updated");
        // });           
          // $categories = Category::get();
          // foreach ($categories as $key => $category) {
          //   $subcategories = SubCategory::where('category_id',$category->id)->pluck('id')->toArray();
          //   $categories[$key]->amount = warehouseStock::whereIn('subcategory_id',$subcategories)->sum('amount');
          // }
          // $sites=Site::where('status',1)->get();
          // foreach ($sites as $key => $site) {
          //     $sites[$key]->amount = SiteStock::where('site_id', $site->id)->sum('amount');
          // }
        return view('home',compact('categories', 'sites'));
        return view('home');
    }
}
