@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sub Categories</div>

                <div class="card-body  light-color">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 class="light-color" id="create">Create a new Sub Category</h3>
                            <form id="create_form" method="post" action="{{route('subcategory.store')}}">
                                {{ csrf_field() }}
                                  <select class="form-control mt-4" id="category" name="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                  </select>
                              <input class="mt-2 mb-2" type="text" id="create_text" name="subcategory" required="true">
                                <input type="submit" id="create_btn" value="Create Sub Category" class="btn btn-info" >
                            </form>
                        </center>
                        <br>
                    @endif
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($categories as $category)
                              <div class="card" id="stock">
                                <div class="card-header" role="tab" id="heading{{$category->id}}">
                                  <h5 class="mb-0">
                                    <a clas="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$category->id}}" id="stock_head" aria-expanded="true" aria-controls="collapse{{$category->id}}">
                                        {{$category->category}}
                                    </a>
                                  </h5>
                                </div>

                                <div id="collapse{{$category->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$category->id}}">
                                  <div class="card-block">
                                    <table class="table">
                                        <tbody>
                                            @foreach($category->sub as $subcategory)
                                                <tr>
                                                    <td>{{$subcategory->subcategory}}</td>
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
