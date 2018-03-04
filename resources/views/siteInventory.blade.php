@extends('layouts.app')

@section('content')
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
                                <select class="form-control" name="site[]">\
                                    <option>Site 1</option>\
                                    <option>Site 2</option>\
                                </select>\
                            </td>\
                            <td>\
                                <input type="number" class="form-control quantity" name="quantity[]" step="0" >\
                            </td>\
                            <td>\
                                <input type="number" class="form-control costing" name="costing[]"  step="0.01">\
                            </td>\
                            <td>\
                                <input type="number" class="form-control amount" name="amount[]"  step="0.01">\
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

<div class="container">
    <div class="row">
        @if(session('errors'))
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-danger">
                      <strong>Danger!</strong> The following items could not be moved to Site.<br>
                        @foreach(session('errors') as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(session('success'))
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-success">
                      <strong>Success!</strong> Items moved to Site.
                    </div>
                </div>
            </div>
        @endif
        <?php session()->forget('errors');session()->forget('success'); ?>
        <center><h2>To Site</h2></center>
        <form method="POST" action="{{ route('siteInventory') }}">
            {{ csrf_field() }}
            <div class="col-md-10 col-md-offset-1" style="overflow-x:auto;">
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 19%;">Category</th>
                            <th style="width: 19%;">Sub Category</th>
                            <th style="width: 15%;">To Site</th>
                            <th style="width: 18%;">Rate/Unit (in Rs)</th>
                            <th style="width: 12%;">Quantity</th>
                            <th style="width: 20% !important;">Total Cost (in Rs)</th>
                            <th style="width: 15%;">Date</th>
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
                                <select class="form-control subcategory" name="subcategories[]">
                                    <option disabled="true">Select Category</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="site[]">
                                    @foreach($sites as $site)
                                        <option value="{{$site->id}}">{{$site->site_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control costing" name="costing[]">
                                    <option disabled="true">Select Sub Category</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control quantity" name="quantity[]" step="0" >
                            </td>
                            <td>
                                <input type="number" class="form-control amount" name="amount[]"   step="0.01">
                            </td>
                            <td>
                                <input type="date" class="form-control" name="date[]" required="true">
                            </td>
                            <td>
                                <img src="{{ asset('/close.png') }}" width="30px;" class="deleteRow">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <span style="float: right;"><input type="button" class="btn btn-sm btn-primary" onclick="addfield()" value="Add Row"></span>
                <br><br>
                <center><input type="submit" class="form-control btn btn-primary" style="width: 100px; margin-bottom: 40px;" name="submit"></center>
            </div>        
        </form>
    </div>
</div>
@endsection
