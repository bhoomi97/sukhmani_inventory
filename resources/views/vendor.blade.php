@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sub Categories</div>

                <div class="card-body">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 id="create">Create a new Vendor</h3>
                            <form id="create_form" method="post" action="{{route('vendor.store')}}">
                                {{ csrf_field() }}
                                Category
                                  <select class="form-control" id="category" name="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                  </select>
                                  Sub Category
                                  <select class="form-control" class="subcategory" id="subcategory" name="subcategory">
                                        <option value="null">Select Category</option>
                                  </select>
                                  Vendor
                                  <input type="text" id="vendor" name="vendor" required="true">
                                  Specification (, seperated)
                                  <input type="text" id="specification" name="specification" required="true">
                                    <input type="submit" id="create_btn" value="Create Vendor" class="btn btn-info" >
                            </form>
                        </center>
                        <br>
                    @endif
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($vendors as $vendor)
                              <div class="card" id="stock">
                                <div class="card-header" role="tab" id="heading{{$vendor->id}}">
                                  <h5 class="mb-0">
                                    <a clas="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$vendor->id}}" id="stock_head" aria-expanded="true" aria-controls="collapse{{$vendor->id}}">
                                        {{$vendor->vendor}}
                                    </a>
                                  </h5>
                                </div>

                                <div id="collapse{{$vendor->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$vendor->id}}">
                                  <div class="card-block">
                                    <table class="table">
                                        <tbody>
                                            @foreach($vendor->specs as $spec)
                                                <tr>
                                                    <td>{{$spec->specification}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                        @endforeach
                    </div> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
