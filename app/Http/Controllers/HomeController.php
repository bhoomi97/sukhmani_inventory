<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WarehouseStock;
use App\Category;
use App\SubCategory;

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
          $categories = Category::get();
          foreach ($categories as $key => $category) {
            $subcategories = SubCategory::where('category_id',$category->id)->pluck('id')->toArray();
            $categories[$key]->amount = warehouseStock::whereIn('subcategory_id',$subcategories)->sum('amount');
          }
        return view('home',compact('categories'));
    }
}
