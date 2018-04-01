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
                <div class="card-header" id="warehouse_stock">{{$site->site_name}} Stock</div>

                <div class="card-body light-bg">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                      <table class="table table-bordered labPaymentReport" id="" width="100%">
                        <thead class="light-color">
                          <tr>
                            <th>Sub Category</th>
                            <th>Contractor</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Comment</th>
                          </tr>
                        </thead>
                        <tbody style="background-color: #fff;">
                        	@foreach($payments as $payment)
                        		<tr>
                        			<th>{{$payment->contractor->subcategory->subcategory}}</th>
                        			<th>{{$payment->contractor->contractor}}</th>
                        			<th>{{$payment->amount}}</th>
                        			<th>{{$payment->date}}</th>
                        			<th>{{$payment->comment}}</th>
                        		</tr>
                        	@endforeach
                        </tbody>
                      </table>
                    </div>

                    <br>
                    <center><a href="#" id="labPaymentReport" class="btn theme">Generate Report</a></center>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
