@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3><a href="{{route('site.index')}}">Add/Remove Site</a></h3>
                    <h3><a href="{{route('warehouseInventory')}}">Add to Warehouse</a></h3>
                    <h3><a href="{{route('siteInventory')}}">Move to Site</a></h3>
                    @if(Auth::user()->role==1)
                      <h3><a href="{{route('warehouseStock')}}">Generate Warehouse Report</a></h3>
                      <h3><a href="{{route('site.index')}}">Generate Site Report</a></h3>
                      <center><div id="chart_div"></div></center>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->role==1)
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
              var options = {'title':'Warehouse Stock',
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
