@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contractor</div>

                <div class="card-body">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 class="light-color" id="create">Create a new Contractor</h3>
                            <form id="create_form" method="post" action="{{route('labcontractor.store')}}">
                                {{ csrf_field() }}
                                  <select class="form-control" id="subcategory" name="subcategory">
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}">{{$subcategory->subcategory}}</option>
                                    @endforeach
                                  </select>
                                <input type="text" id="create_text" name="contractor" required="true">
                                <input type="submit" id="create_btn" value="Create Contractor" class="btn btn-info">
                            </form>
                        </center>
                        <br>
                    @endif
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($subcategories as $subcategory)
                              <div class="card" id="stock">
                                <div class="card-header" role="tab" id="heading{{$subcategory->id}}">
                                  <h5 class="mb-0">
                                    <a clas="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$subcategory->id}}" id="stock_head" aria-expanded="true" aria-controls="collapse{{$subcategory->id}}">
                                        {{$subcategory->subcategory}}
                                    </a>
                                  </h5>
                                </div>

                                <div id="collapse{{$subcategory->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$subcategory->id}}">
                                  <div class="card-block">
                                    <table class="table">
                                        <tbody>
                                            @foreach($subcategory->sub as $contractor)
                                                <tr>
                                                    <td>{{$contractor->contractor}}</td>
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
