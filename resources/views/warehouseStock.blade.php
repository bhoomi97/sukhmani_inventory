@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">WareHouse Stock</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($categories as $category)
                            @if(count($category->stock))
                              <div class="card">
                                <div class="card-header" role="tab" id="heading{{$category->id}}">
                                  <h5 class="mb-0">
                                    <a clas="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$category->id}}" aria-expanded="true" aria-controls="collapse{{$category->id}}">
                                        {{$category->category}}<span style="float: right;"> (Total Amt: {{$category->amount}})</span>
                                    </a>
                                  </h5>
                                </div>

                                <div id="collapse{{$category->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$category->id}}">
                                  <div class="card-block">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sub Category</th>
                                                <th>Rate</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Comment</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>                            
                                        <tbody>
                                            @foreach($category->stock as $stock)
                                                <tr>
                                                    <td>{{$stock->subcategory->subcategory}}</td>
                                                    <td>{{$stock->rate}}</td>
                                                    <td>{{$stock->qty}}</td>
                                                    <td>{{$stock->amount}}</td>
                                                    <td>{{$stock->comment}}</td>
                                                    <td>{{$stock->date}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            @endif
                        @endforeach
                      
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
