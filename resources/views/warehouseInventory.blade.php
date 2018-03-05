@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<script type="text/javascript">
    var count = 1;
    function addfield() {
        $("#table").append('\
                        <tr count='+count+'>\
                            <td>\
                                <select class="form-control category" name="categories[]">\
                                    <option >Select Category</option>\
                                    @foreach($cats as $cat)\
                                        <option value="{{$cat->id}}">{{$cat->category}}</option>\
                                    @endforeach\
                                </select>\
                            </td>\
                            <td>\
                                <select class="form-control subcategory" name="subcategories[]">\
                                    <option disabled="true">Select Category</option>\
                                </select>\
                            </td>\
                            <td>\
                                <input type="number" class="form-control costing" name="costing[]" step="0.01" >\
                            </td>\
                            <td>\
                                <input type="number" class="form-control quantity" name="quantity[]" step="1">\
                            </td>\
                            <td>\
                                <input type="number" class="form-control amount" name="amount[]" step="0.01" >\
                            </td>\
                            <td>\
                                <input type="test" class="form-control comment" name="comment[]">\
                            </td>\
                            <td>\
                                <input type="date" class="form-control" name="date[]" required="true">\
                            </td>\
                            <td>\
                                <img src="{{ asset('/close.png') }}" width="30px;" class="deleteRow">\
                            </td>\
                        </tr>\
            ')
        count++;
        return;   
    }

</script>

<div class="container-fluid">
  <div class="jumbotron">
    <div class="row">
        <center><h2 id="warehouse_head">Warehouse Inventory</h2></center>
        <form method="POST" action="{{route('saveWarehouseInventory')}}">
            {{ csrf_field() }}
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Category</th>
                            <th style="width: 19%;">Sub Category</th>
                            <th style="width: 15%;" id="rate">Rate/Unit(Rs)</th>
                            <th style="width: 12%;">Quantity</th>
                            <th style="width: 15%;">Total Cost(Rs)</th>
                            <th style="width: 15%;">Comment</th>
                            <th style="width:10%;">Date</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        <tr count="0">
                            <td>
                                <select class="form-control category" name="categories[]">
                                    <option >Select Category</option>
                                    @foreach($cats as $cat)
                                        <option value="{{$cat->id}}">{{$cat->category}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control subcategory" id="warehouse_subcat" name="subcategories[]">
                                    <option disabled="true">Select Category</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control costing" name="costing[]"  step="0.01">
                            </td>
                            <td>
                                <input type="number" class="form-control quantity" name="quantity[]" step="1" >
                            </td>
                            <td>
                                <input type="number" class="form-control amount" name="amount[]" step="0.01" >
                            </td>
                            <td>
                                <input type="test" class="form-control comment" name="comment[]">
                            </td>
                            <td>
                                <input type="date" id="datepicker" class="form-control" name="date[]" required="true">
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
    </div>
  </div>
</div>
@endsection
