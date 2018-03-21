@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vendors</div>

                <div class="card-body">

                    <div id="accordion" role="tablist" aria-multiselectable="true">
                          <table class="table">
                            <tr>
                              <th>Vendor</th>
                              <th>Warehouse Stock</th>
                              <th>Site Stock</th>
                            </tr>
                        @foreach($vendors as $vendor)
                          <tr>
                            <td>{{$vendor->vendor}}</td>
                            <td><a href="{{URL::to('vendor/stock/'.($vendor->id))}}">Warehouse Stocks</a></td>
                            <td><a href="{{URL::to('vendor/site/stock/'.($vendor->id))}}">Site Stocks</a></td>
                          </tr>
                        @endforeach
                          </table>
                    </div> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
