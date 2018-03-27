@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<script type="text/javascript">
    var count = 1;
    function addfield() {
        $("#table").append('\
            <tr count='+count+'>\
            <td>\
            <select class="form-control labsubcategory" name="categories[]">\
            <option >Select Category</option>\
            @foreach($categories as $category)\
            <option value="{{$category->id}}">{{$category->subcategory}}</option>\
            @endforeach\
            </select>\
            </td>\
            <td>\
            <select class="form-control contractor" id="warehouse_subcat" name="subcategories[]" required="">\
            <option disabled="true">Select Category</option>\
            </select>\
            </td>\
            <td>\
            <input type="number" class="form-control amount" name="amount[]" step="0.01" required="">\
            </td>\
            <td>\
            <select class="form-control site" id="sites" name="sites[]" required="">\
            @foreach($sites as $site)\
            <option value="{{$site->id}}">{{$site->site_name}}</option>\
            @endforeach\
            <option value="all">ALL Sites</option>\
            </select>\
            </td>\
            <td>\
            <input type="date" class="form-control date" name="date[]" required="">\
            </td>\
            <td>\
            <input type="text" class="form-control comment" name="comment[]" >\
            </td>\
            <td>\
            <img src="{{ asset('/close.png') }}" width="30px;" style="cursor: pointer;" class="deleteRow">\
            </td>\
            </tr>\
            ')
        count++;
        return;   
    }

</script>

<div class="container">
  <div class="jumbotron">
    <div class="row">
        <div class="row" style="width: 100%;">
            <h3>
                <a class="btn btn-primary" href="{{route('labcontractor.index')}}">Contractors</a>
                <a class="btn btn-primary" href="{{route('labsubcategory.index')}}">Labour SubCategories</a>
            </h3>
        </div>
        <div class="row" style="width: 100%; text-align: center;">
            <h2 id="warehouse_head" style="margin: auto;">Labour Payment</h2>
            
        </div>
        <form method="POST" action="{{route('labpayment.store')}}">
            {{ csrf_field() }}
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Category</th>
                            <th style="width: 19%;">Contractor</th>
                            <th style="width: 19%;">Amount</th>
                            <th style="width: 19%;">Site</th>
                            <th style="width: 19%;">Date</th>
                            <th style="width: 19%;">Comment</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        <tr count="0">
                            <td>
                                <select class="form-control labsubcategory" name="categories[]">
                                    <option >Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->subcategory}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control contractor" id="warehouse_subcat" name="contractors[]" required="">
                                    <option disabled="true">Select Category</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control amount" name="amount[]" step="0.01" >
                            </td>
                            <td>
                                <select class="form-control site" id="sites" name="sites[]">
                                    @foreach($sites as $site)
                                    <option value="{{$site->id}}">{{$site->site_name}}</option>
                                    @endforeach
                                    <option value="all">ALL Sites</option>
                                </select>
                            </td>
                            <td>
                                <input type="date" class="form-control date" name="date[]" required="">
                            </td>
                            <td>
                                <input type="text" class="form-control comment" name="comment[]" >
                            </td>
                            <td>
                                <img src="{{ asset('/close.png') }}" width="30px;" style="cursor: pointer;" class="deleteRow">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <span style="float: right;"><input type="button" class="btn btn-sm btn-primary" onclick="addfield()" value="Add Row"></span>
                <br><br>
                <center><input type="submit" class="form-control btn btn-primary" style="width: 150px;margin-bottom: 40px;" name="submit"></center>
            </div>        
        </form>

        <div class="row" style="width: 100%; text-align: center;">
            <h2 id="warehouse_head" style="margin: auto;">Staff Salary</h2>
        </div>
        <form method="post" action="{{route('labpayment.salary')}}">
            @csrf
            <table class="table table-hover table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Contractor</th>
                        <th>Amount</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Sites</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control contractor" id="warehouse_subcat" name="contractor" required="">
                                @foreach($conts as $cont)
                                    <option value="{{$cont->id}}">{{$cont->contractor}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="">
                                <input class="form-control" type="number" name="amount" required="">
                            </div>
                        </td>
                        <td>
                            <div class="">
                                <input class="form-control" type="text" name="comment">
                            </div>
                        </td>
                        <td>
                            <div class="">
                                <input class="form-control" type="date" name="date" required="">
                            </div>
                        </td>
                        <td>
                            @foreach($sites as $site)
                                <div class="checkbox">
                                    <label class="checkbox"><input type="checkbox" value="{{$site->id}}" name="site[]">{{$site->site_name}}</label>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
                <center><input type="submit" class="form-control btn btn-primary" style="width: 150px;margin-bottom: 40px;" name="submit"></center>            
        </form>
    </div>
</div>
</div>
@endsection
