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
                                <select class="form-control specification" id="warehouse_specification" \name="specifications[]">\
                                    <option disabled="true">Select Vendor</option>\
                                </select>\
                            </td>\
                            <td>\
                                <select class="form-control site" id="site_list" name="sites[]">\
                                    @foreach($sites as $site)\
                                        <option value="{{$site->id}}">{{$site->site_name}}</option>\
                                    @endforeach\
                                </select>\
                            </td>\
                            <td>\
                                <select class="form-control costing" id="warehouse_costing" name="costings[]">\
                                    <option disabled="true">Select Specification</option>\
                                </select>                                \
                            </td>\
                            <td>\
                                <input type="number" class="form-control quantity" name="quantity[]" step="1" >\
                                <span class="quan_max"></span>\
                            </td>\
                            <td>\
                                <input type="number" class="form-control amount" name="amount[]" step="0.01" >\
                            </td>\
                            <td>\
                                <input type="text" class="form-control delivered_to" name="delivered_to[]">\
                            </td>\
                            <td>\
                                <input type="text" class="form-control delivered_by" name="delivered_by[]">\
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

<div class="container light-bg light-color">
    <div class="pt-3 pb-3">
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
        @if($s==1)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-success">
                      <strong>Success!</strong> Items moved to Site.
                    </div>
                </div>
            </div>
            <?php $s=0; ?>
        @endif
        <?php session()->forget('errors');session()->forget('success'); ?>
        <div class="text-center font-weight-bold">
            <h2 id="site_head">To Site</h2>
        </div>
        <form method="POST" action="{{ route('siteInventory') }}">
            {{ csrf_field() }}
            <div class="col-md-12" style="overflow-x:auto;">
                <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th class="th-lg">Category</th>
                            <th class="th-lg">Sub Category</th>
                            <th class="th-lg">Vendor</th>
                            <th class="th-lg">Specification</th>
                            <th class="th-lg" >To Site</th>
                            <th class="th-lg" id="rate">Rate/Unit(Rs)</th>
                            <th class="th-lg">Quantity</th>
                            <th class="th-lg">Total Cost(Rs)</th>
                            <th class="th-lg">Delivered To</th>
                            <th class="th-lg">Delivered By</th>
                            <th class="th-lg">Comment</th>
                            <th class="th-lg" >Date</th>
                            <th class="th-lg" >Delete</th>
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
                                <select class="form-control site" id="site_list" name="sites[]">
                                    @foreach($sites as $site)
                                        <option value="{{$site->id}}">{{$site->site_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control costing" id="warehouse_costing" name="costings[]">
                                    <option disabled="true">Select Specification</option>
                                </select>                                
                            </td>
                            <td>
                                <input type="number" class="form-control quantity" name="quantity[]" step="1" >
                                <span class="quan_max"></span>
                            </td>
                            <td>
                                <input type="number" class="form-control amount" name="amount[]" step="0.01" >
                            </td>
                            <td>
                                <input type="text" class="form-control delivered_to" name="delivered_to[]">
                            </td>
                            <td>
                                <input type="text" class="form-control delivered_by" name="delivered_by[]">
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

                <button class="float-right light-color" style="background-color: transparent; border: none;cursor: pointer;" onclick="addfield()" >  
                    <span class= "fas fa-plus-circle fa-2x theme-color-text mt-2"></span> Add Row
                </button>


                
                <br><br>

                <center><input type="submit" class="form-control btn theme" style="width: 150px; margin-bottom: 40px;" name="submit"></center>
            </div>
                  
        </form>
    </div>
  
</div>
@endsection
@section('script')
<script type="text/javascript">

        $(document).on("change", ".specification", function(){
            specification = $(this).val();
            c = $(this).closest('tr').attr('count');
            $.ajax({
                type: 'GET',
                url: 'getspecificationratesfortosite',
                data: {
                    'specification' : specification,
                    'c' : c
                },
                success: function(data){
                    console.log(data);
                    if(data[0].length === 0){
                        alert("No Items Present in Warehouse.");
                        return;
                    }
                    $("tr[count='"+data[1]+"']").find(".costing").html('');
                    $("tr[count='"+data[1]+"']").find(".quantity").attr('max',data[0][0][1]);
                    console.log("#"+data[0][0].qty);
                    $("tr[count='"+data[1]+"']").find(".quan_max").html('max: '+data[0][0][1]);
                    $("tr[count='"+data[1]+"']").find(".quantity").attr('placeholder','max: '+data[0][0][1]);
                    data[0].forEach(function(d){
                        $("tr[count='"+data[1]+"']").find(".costing").append('<option value='+d[0]+'>'+d[0] +'</option>');
                        console.log(d);
                    })
                }
            });
        });

        $(document).on("change", ".costing", function(){
            costing = $(this).val();
            c = $(this).closest('tr').attr('count');
            specification = $("tr[count='"+c+"']").find(".specification").val();
            $.ajax({
                type: 'GET',
                url: 'getmaxquantity',
                data: {
                    'specification' : specification,
                    'costing' : costing,
                    'c' : c
                },
                success: function(data){
                    console.log(data);
                    $("tr[count='"+data[1]+"']").find(".quantity").attr('max',data[0]);
                    $("tr[count='"+data[1]+"']").find(".quan_max").html('max: '+data[0]);
                    $("tr[count='"+data[1]+"']").find(".quantity").attr('placeholder','max:'+data[0]);
                }
            });
        });

    
</script>
@endsection