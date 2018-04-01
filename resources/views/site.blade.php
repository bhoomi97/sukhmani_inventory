@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-header">Sites</div>

                <div class="card-body light-color light-bg">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 class="light-color" id="create">Create a new Site</h3>
                            <form id="create_form" method="post" action="{{route('site.store')}}">
                                {{ csrf_field() }}
                                <input type="text" id="create_text" name="site" required="true">
                                <input type="submit" id="create_btn" value="Create site" class="btn btn-info" >
                            </form>
                        </center>
                        <br>
                    @endif
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="th-md">Site Name</th>
                                <th class="th-md">Created By</th>
                                <th class="th-md">Deleted By</th>
                                <th class="th-md">Status</th>
                                @if(Auth::user()->role == 1)
                                    <th class="th-md">Finish</th>
                                    <!-- <th class="th-md">Stock</th> -->
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sites as $site)
                                <tr>
                                    <td class="align-middle">{{$site->site_name}}</td>
                                    <td class="align-middle">{{$site->createduser->name}}</td>
                                    <td class="align-middle">
                                        @if(isset($site->deleteduser->name))
                                            {{$site->deleteduser->name}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td class="align-middle">
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
                                                    {{ Form::submit('Finish', ['class' => 'btn btn-danger']) }}
                                                {{ Form::close() }}
                                            @endif                                        
                                        </td>
                                        <!-- <td>
                                        @if($site->status == 1)
                                            <button class="btn btn-default">
                                                  <a href="{{route('site.show',$site->id)}}" id="create_stock">Stock</a>
                                            </button>
                                        @else
                                            --
                                        @endif
                                        </td> -->
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
</div>
@endsection
