@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 id="create">Create a new Category</h3>
                            <form id="create_form" method="post" action="{{route('category.store')}}">
                                {{ csrf_field() }}
                                <input type="text" id="create_text" name="category" required="true">
                                <input type="submit" id="create_btn" value="Create Category" class="btn btn-info" >
                            </form>
                        </center>
                        <br>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->category}}</td>
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
