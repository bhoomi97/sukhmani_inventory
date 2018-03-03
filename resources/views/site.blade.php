@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sites</div>

                <div class="card-body">
                    @if(Auth::usder()->role == 1)
                        <form method="post" action="{{route('site.store')}}">
                            {{ csrf_field() }}
                            <input type="text" name="site" required="true">
                            <input type="submit" class="btn" >
                        </form>
                    @endif
                    <table>
                        <thead>
                            <tr>
                                <th>Site Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sites as $site)
                                <tr>
                                    <td>{{$site->site_name}}</td>
                                    <td>
                                        @if($site->status == 1)
                                            Active
                                        @else
                                            InActive
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
