@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/warehouseStock.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="warehouse_stock">WareHouse Stock</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row"><center style="margin: auto;"><h4>Warehouse Stock (Total Amount: Rs.{{$total}})</h4></center></div>
                      <center><div id="chart_div"></div></center>
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($categories as $category)
                            @if(count($category->stock))
                              <div class="card" id="stock">
                                <div class="card-header" role="tab" id="heading{{$category->id}}">
                                  <h5 class="mb-0">
                                    <a clas="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$category->id}}" id="stock_head" aria-expanded="true" aria-controls="collapse{{$category->id}}">
                                        {{$category->category}}<span style="float: right;"> (Total Amt: Rs.{{$category->amount}})</span>
                                    </a>
                                  </h5>
                                </div>

                                <div id="collapse{{$category->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$category->id}}">
                                  <div class="card-block">
                                    <table class="table" id="stock_table">
                                        <thead>
                                            <tr>
                                                <th>Sub Category</th>
                                                <th>Rate</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Comment</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>                            
                                        <tbody>
                                            @foreach($category->stock as $stock)
                                                <tr>
                                                    <td>{{$stock->subcategory->subcategory}}</td>
                                                    <td>{{$stock->rate}}</td>
                                                    <td>{{$stock->qty}}</td>
                                                    <td>{{$stock->amount}}</td>
                                                    <td>{{$stock->comment}}</td>
                                                    <td>{{$stock->date}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            @endif
                        @endforeach
                        <table style="display: none;" class="warehousestock">
                          <thead>
                              <tr>
                                  <th>Sub Category</th>
                                  <th>Rate</th>
                                  <th>Quantity</th>
                                  <th>Amount</th>
                                  <th>Comment</th>
                                  <th>Date</th>
                              </tr>
                          </thead>                            
                          <tbody>
                          @foreach($categories as $category)
                              @if(count($category->stock))
                                @foreach($category->stock as $stock)
                                    <tr>
                                        <td>{{$stock->subcategory->subcategory}}</td>
                                        <td>{{$stock->rate}}</td>
                                        <td>{{$stock->qty}}</td>
                                        <td>{{$stock->amount}}</td>
                                        <td>{{$stock->comment}}</td>
                                        <td>{{$stock->date}}</td>
                                    </tr>
                                @endforeach
                              @endif
                          @endforeach
                          </tbody>
                          
                        </table>
                    </div> 
                    <br>
                    <center><a href="" id="warehouseexport" class="btn btn-primary">Generate Report</a></center>
                </div>
            </div>
        </div>
    </div>
</div>

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
@endsection
