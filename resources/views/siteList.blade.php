@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sites</div>

                <div class="card-body light-color">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 class="light-color" id="create">Site Stock</h3>
                            <form id="create_form" method="post" action="{{route('site.store')}}">
                                {{ csrf_field() }}
                                <input type="text" id="create_text" name="site" required="true">
                                <input type="submit" id="create_btn" value="Create site" class="btn btn-info" >
                            </form>
                        </center>
                        <br>
                    @endif
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
                                    <td>{{$site->site_name}}</td>
                                    <td>{{$site->createduser->name}}</td>
                                    <td>
                                        <a href="{{route('site.show',$site->id)}}" id="create_stock">Stock</a>
                                    </td>
                                    <td>
                                        <a href="{{route('labpayment.show',$site->id)}}" id="create_stock">Payments</a>
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
@endsection
