@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Labour SubCategories</div>

                <div class="card-body light-color light-bg">
                    @if(Auth::user()->role == 1)
                        <center>
                            <h3 class="light-color" id="create">Create a new Sub Category</h3>
                            <form id="create_form" method="post" action="{{route('labsubcategory.store')}}">
                                {{ csrf_field() }}
                                <input type="text" id="create_text" name="category" required="true">
                                <input type="submit" id="create_btn" value="Create SubCategory" class="btn btn-info" >
                            </form>
                        </center>
                        <br>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold text-uppercase">
                                    <h5>SubCategory Name</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cats as $category)
                                <tr>
                                    <td>{{$category->subcategory}}</td>
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
