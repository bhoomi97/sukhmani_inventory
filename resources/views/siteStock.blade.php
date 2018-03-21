@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/siteStock.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="stock_card">{{$site->site_name}} Stock</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row"><center style="margin: auto;"><h4>Site Stock</h4></center></div>
                      <center><div id="chart_div"></div></center>
                        <table class="sitestock table">
                          <thead>
                              <tr>
                                  <th>Category</th>
                                  <th>Sub Category</th>
                                  <th>Vendor</th>
                                  <th>Specification</th>
                                  <th>Rate</th>
                                  <th>Quantity</th>
                                  <th>Amount</th>
                                  <th>Delivered To</th>
                                  <th>Delivered By</th>
                                  <th>Comment</th>
                                  <th>Date</th>
                              </tr>
                          </thead>                            
                          <tbody>
                            @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{$stock->specification->vendor->subcategory->category->category}}</td>
                                        <td>{{$stock->specification->vendor->subcategory->subcategory}}</td>
                                        <td>{{$stock->specification->vendor->vendor}}</td>
                                        <td>{{$stock->specification->specification}}</td>
                                        <td>{{$stock->rate}}</td>
                                        <td>{{$stock->qty}}</td>
                                        <td>{{$stock->amount}}</td>
                                        <td>{{$stock->delivered_to}}</td>
                                        <td>{{$stock->delivered_by}}</td>
                                        <td>{{$stock->comment}}</td>
                                        <td>{{$stock->date}}</td>
                                    </tr>
                            @endforeach
                          </tbody>
                        </table>
                    <br>
                    <center><a href="" id="siteexport" class="btn btn-primary">Generate Report</a></center>

                </div>
            </div>
        </div>
    </div>
</div>
@if(0)
  <script type="text/javascript">
      document.addEventListener('DOMContentLoaded',function(){

            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

              // Create the data table.
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'Category');
              data.addColumn('number', 'Amount');
              data.addRows([
                  @foreach($categories as $category)
                      ['{{$category->category}}',{{$category->amount}}],
                  @endforeach
              ]);

              // Set chart options
              var options = {'title':'',
                             'width':400,
                             'height':300};

              // Instantiate and draw our chart, passing in some options.
              var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
              chart.draw(data, options);
            }        
      })
  </script>
@endif
@endsection
