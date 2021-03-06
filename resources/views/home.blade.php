@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header theme">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 col-md-6 border-right list-group no-border-sm">
                          
                            <a class="list-group-item waves-effect light-bg light-color" href="{{route('site.index')}}" id="add_site">Manage Sites</a>
                            <a class="list-group-item waves-effect light-bg light-color" href="{{route('warehouseInventory')}}" id="add_warehouse">Add to Warehouse</a>
                            <a class="list-group-item waves-effect light-bg light-color" href="{{route('siteInventory')}}" id="move_site">Move to Site</a>
                            <a class="list-group-item waves-effect  light-bg light-color" href="{{route('vendor.index')}}" id="move_site">Vendor</a>
                            <a class="list-group-item waves-effect light-bg light-color" href="{{route('labpayment.create')}}" id="move_site">Labour Payment</a>
                              
                        </div>
                        @if(Auth::user()->role==1)
                        <div class="col-12 col-md-6 list-group mt-sm">
                          <a class="list-group-item waves-effect light-bg light-color" href="{{route('warehouseStock')}}" id="gen_warehouse">Generate Warehouse Report</a>
                          <a class="list-group-item waves-effect light-bg light-color" href="{{route('site.index')}}" id="gen_site">Generate Site Report</a>
                          <a class="list-group-item waves-effect light-bg light-color" href="{{route('vendorStock')}}" id="gen_site">Generate Vendor Report</a>
                          <a class="list-group-item waves-effect light-bg light-color" href="{{route('siteList')}}" id="gen_site">Generate Labour Payment Report</a>
                        </div>
                    </div>
                    <div class="card-header mt-4">Warehouse Stock</div>
                    <div class="jumbotron light-bg">
                      <center><div id="chart_div" style="width: 100%"></div></center>
                    </div>
                    <div class="card-header">Site Wise Stock</div>
                    <div class="jumbotron light-bg">
                      <center><div id="chart_div1" style="width: 100%px; height: 500px;"></div></center>
                    </div>
                    <div class="card-header">Vendor Stock</div>
                    <div class="jumbotron light-bg">
                      <center><div id="chart_div1" style="width: 100%px; height: 500px;"></div></center>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->role==2)
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
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded',function(){
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
                  ['Element', 'Density'],
            @foreach($sites as $site)
              ['{{$site->site_name}}', parseInt({{$site->amount}})],
            @endforeach
            ]);
          var options = {
            title: '',
            legend: { position: 'none' },
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
          chart.draw(data, options);
        }
      });
    </script>
  @endif
@endsection
