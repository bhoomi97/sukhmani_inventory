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
                                <select class="form-control subcategory" id="warehouse_subcat" name="subcategories[]">\
                                    <option disabled="true">Select Category</option>\
                                </select>\
                            </td>\
                            <td>\
                                <select class="form-control vendor" id="warehouse_vendor" name="vendors[]">\
                                    <option disabled="true">Select SubCategory</option>\
                                </select>\
                            </td>\
                            <td>\
                                <select class="form-control specification" id="warehouse_specification" name="specifications[]">\
                                    <option disabled="true">Select Vendor</option>\
                                </select>\
                            </td>\
                            <td>\
                                <input type="number" class="form-control costing" name="costing[]"  step="0.01">\
                            </td>\
                            <td>\
                                <input type="number" class="form-control quantity" name="quantity[]" step="1" >\
                            </td>\
                            <td>\
                                <input type="number" class="form-control amount" name="amount[]" step="0.01" >\
                            </td>\
                            <td>\
                                <input type="text" class="form-control purchased_by" name="purchased_by[]">\
                            </td>\
                            <td>\
                                <input type="text" class="form-control recieved_by" name="recieved_by[]">\
                            </td>\
                            <td>\
                                <input type="test" class="form-control comment" name="comment[]">\
                            </td>\
                            <td>\
                                <input type="date" id="datepicker" class="form-control" name="date[]" required="true">\
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

<div class="wh-inv container light-bg light-color">
  
    <div class="">
        <div class="text-center" style="width: 100%;">
            <h3>
                <a class="btn theme" href="{{route('category.index')}}">Category</a>
                <a class="btn theme" href="{{route('subcategory.index')}}">SubCategory</a>
                <a class="btn theme" href="{{route('vendor.index')}}">Vendor</a>
            </h3>
        </div>
        <div class="text-center font-weight-bold">
            <h2 id="warehouse_head">Warehouse Stock</h2>
            
        </div>
        <form method="POST" action="{{route('saveWarehouseInventory')}}">
            {{ csrf_field() }}
            <div class="col-md-12" style="overflow-x:auto;">
                <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed w-auto">
                    <thead>
                        <tr>
                            <th class="th-lg">Category</th>
                            <th class="th-lg">Sub Category</th>
                            <th class="th-lg">Vendor</th>
                            <th class="th-lg">Specification</th>
                            <th class="th-lg" id="rate">Rate/Unit(Rs)</th>
                            <th class="th-lg">Quantity</th>
                            <th class="th-lg" >Total Cost(Rs)</th>
                            <th class="th-lg">Purchased By</th>
                            <th class="th-lg">Recieved By</th>
                            <th class="th-lg">Comment</th>
                            <th class="th-lg" >Date</th>
                            <th class="th-lg">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        <tr count="0">
                            <td class="w-auto">
                                <select class="form-control category " name="categories[]">
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
                                <select class="form-control vendor" id="warehouse_vendor" name="vendors[]">
                                    <option disabled="true">Select SubCategory</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control specification" id="warehouse_specification" name="specifications[]">
                                    <option disabled="true">Select Vendor</option>
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
                                <input type="text" class="form-control purchased_by" name="purchased_by[]">
                            </td>
                            <td>
                                <input type="text" class="form-control recieved_by" name="recieved_by[]">
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
                </div>
                <button class="float-right" style="background-color: transparent; border: none;cursor: pointer;" onclick="addfield()" alt="Add Row">
                    <span  class="fas fa-plus-circle fa-2x theme-color-text mt-2"></span>
                </button>
                <br><br>
                <center><input type="submit" class="form-control btn theme" style="width: 150px;margin-bottom: 40px;" name="submit"></center>
            </div>        
        </form>
    </div>
  
</div>
@endsection
