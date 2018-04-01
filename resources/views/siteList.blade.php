@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-header">Sites</div>

                <div class="card-body light-color light-bg">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 class="light-color" id="create">
                                Site Reports and Labour Payments
                            </h3>
                            
                        </center>
                        <br>
                    @endif
                    <div class="table-responsive">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Site Name</th>
                                <th>Created By</th>
                                <th>Stock</th>
                                <th>Lab Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sites as $site)
                                <tr>
                                    <td class="align-middle">{{$site->site_name}}</td>
                                    <td class="align-middle">{{$site->createduser->name}}</td>
                                    <td>
                                        <button class="btn btn-default">
                                            <a href="{{route('site.show',$site->id)}}" id="create_stock">Stock</a>
                                        </button>
                                        
                                    </td>
                                    <td >
                                        <button class="btn btn-success">
                                            <a href="{{route('labpayment.show',$site->id)}}" id="create_stock">Payments</a>    
                                        </button>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
