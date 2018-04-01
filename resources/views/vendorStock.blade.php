@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/warehouseStock.css')}}">
<link rel="stylesheet" type="text/css" href="css/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.16/features/searchHighlight/dataTables.searchHighlight.css">
<script type="text/javascript" src="js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/datatables/jquery.highlight.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.16/features/searchHighlight/dataTables.searchHighlight.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="card trans-bg">
                <div class="card-header" id="warehouse_stock">{{$vendor[0]->vendor}} Stock</div>

                <div class="card-body light-bg">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                    
                      <table class="table table-bordered vendorWarehouseStock" id="" width="100%">
                        <thead class="light-color">
                          <tr>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Specification</th>
                            <th>Rate/Unit (Rs)</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody style="background-color: #fff;">
                        	@foreach($stocks as $stock)
                        		<tr>
                        			<th>{{$stock->specification->vendor->subcategory->category->category}}</th>
                        			<th>{{$stock->specification->vendor->subcategory->subcategory}}</th>
                        			<th>{{$stock->specification->specification}}</th>
                        			<th>{{$stock->rate}}</th>
                        			<th>{{$stock->qty}}</th>
                        			<th>{{$stock->amount}}</th>
                        			<th>{{$stock->date}}</th>
                        		</tr>
                        	@endforeach
                        </tbody>
                      </table>
                      </div>

                    <br>
                    <center><a href="#" id="vendorWarehouseStock" class="btn theme">Generate Report</a></center>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
