@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sites</div>

                <div class="card-body">
                    @if(Auth::user()->role == 1)
                        <form method="post" action="{{route('site.store')}}">
                            {{ csrf_field() }}
                            <input type="text" name="site" required="true">
                            <input type="submit" class="btn" >
                        </form>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Site Name</th>
                                <th>Created By</th>
                                <th>Deleted By</th>
                                <th>Status</th>
                                <th>Delete</th>
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
                                    <td>
                                        @if($site->status == 0)
                                            --
                                        @else
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['site.destroy', $site->id]]) }}
                                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                            {{ Form::close() }}
                                        @endif                                        
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
