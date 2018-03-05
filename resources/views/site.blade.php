@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sites</div>

                <div class="card-body">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 id="create">Create a new Site</h3>
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
                                <th>Deleted By</th>
                                <th>Status</th>
                                @if(Auth::user()->role == 1)
                                    <th>Delete</th>
                                    <th>Stock</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sites as $site)
                                <tr>
                                    <td>{{$site->site_name}}</td>
                                    <td>{{$site->createduser->name}}</td>
                                    <td>
                                        @if(isset($site->deleteduser->name))
                                            {{$site->deleteduser->name}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td>
                                        @if($site->status == 1)
                                            Active
                                        @else
                                            InActive
                                        @endif 
                                    </td>
                                    @if(Auth::user()->role == 1)
                                        <td>
                                            @if($site->status == 0)
                                                --
                                            @else
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['site.destroy', $site->id]]) }}
                                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                                {{ Form::close() }}
                                            @endif                                        
                                        </td>
                                        <td>
                                        @if($site->status == 1)
                                            <a href="{{route('site.show',$site->id)}}" id="create_stock">Stock</a>
                                        @else
                                            --
                                        @endif
                                        </td>
                                    @endif
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
