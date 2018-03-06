<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use Auth;
use App\SiteStock;
use App\Category;
use App\SubCategory;
use App\WarehouseStock;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::get();
        return view('site',compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role == 1){
            $site = new Site;
            $site->site_name = $request->site;
            $site->created_user_id = Auth::user()->id;
            $site->save();
            return redirect('/site');
        }
        else{
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role!=1)
            abort('404');
            $site = Site::where('id',$id)->first();
        $total = SiteStock::where('site_id',$id)->sum('amount');
          $categories = Category::get();
          foreach ($categories as $key => $category) {
            $subcategories = SubCategory::where('category_id',$category->id)->pluck('id')->toArray();
            $categories[$key]->stock = SiteStock::where('site_id',$id)->whereIn('subcategory_id',$subcategories)->where('qty','!=',0)->get();
            $categories[$key]->amount = SiteStock::where('site_id',$id)->whereIn('subcategory_id',$subcategories)->sum('amount');
          }
        return view('siteStock',compact('categories','site','total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role == 1){
            $site = Site::where('id',$id)->get();
            if(count($site) == 0){
                return abort('404');
            }
            $site = $site[0];
            $stocks = SiteStock::where('site_id',$site->id)->get();
            foreach ($stocks as $stock) {
                $s = WarehouseStock::where('subcategory_id',$stock->subcategory_id)->where('rate',$stock->rate)->first();
                $s->qty+=$stock->qty;
                $s->amount+=$stock->amount;
                $s->save();
            }
            $site->status = 0;
            $site->deleted_user_id = Auth::user()->id;
            $site->save();
            return redirect('/site');
        }
        else
            abort('404');
    }
}
