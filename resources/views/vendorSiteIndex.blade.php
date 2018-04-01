@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="card light-color">
                <div class="card-header">Vendors</div>

                <div class="card-body light-bg">

                    <div id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr class="text-uppercase">
                                  <th class="th-sm" >Vendor</th>
                                  <th class="th-sm">Warehouse Stock</th>
                                  <th class="th-sm">Site Stock</th>
                                </tr>
                              </thead>
                            
                        @foreach($vendors as $vendor)
                          <tr>
                            <td class="align-middle">{{$vendor->vendor}}</td>
                            <td>
                              <button class="btn btn-secondary p-2">
                                <a href="{{URL::to('vendor/stock/'.($vendor->id))}}" style="color: #fff;">Warehouse Stock</a>                             
                              </button>
                            </td>
                            <td>
                              <button class="btn btn-warning p-2">
                                <a href="{{URL::to('vendor/site/stock/'.($vendor->id))}}" style="color: #fff;">Site Stock</a>                           
                              </button>
                            </td>
                          </tr>
                        @endforeach
                          </table>  
                          </div>
                          
                    </div> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
