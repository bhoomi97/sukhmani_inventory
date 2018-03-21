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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="warehouse_stock">WareHouse Stock</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                      <center><div id="chart_div"></div></center>
                      <table class="table table-bordered warehousestock" id="warehouse-stock-table" width="100%">
                        <thead>
                          <tr>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Vendor</th>
                            <th>Specification</th>
                            <th>Rate/Unit (Rs)</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Purchased By</th>
                            <th>Recieved By</th>
                            <th>Comment</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                      </table>

                    <br>
                    <center><a href="" id="warehouseexport" class="btn btn-primary">Generate Report</a></center>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

  $(function() {
    var table = $('#warehouse-stock-table').DataTable({
      processing: true,
      serverSide: true,
      searchHighlight: true,
      ajax: '{!! route('datatables.warehouseStock') !!}',
      columns: [
        { data: 'category', name: 'category' },
        { data: 'subcategory', name: 'subcategory' },
        { data: 'vendor', name: 'vendor' },
        { data: 'specification', name: 'specification' },
        { data: 'rate', name: 'rate' },
        { data: 'qty', name: 'qty' },
        { data: 'amount', name: 'amount' },
        { data: 'purchased_by', name: 'purchased_by'  },
        { data: 'recieved_by', name: 'recieved_by'  },
        { data: 'comment', name: 'comment'  },
        { data: 'date', name: 'date' }
      ]
    });
  });
$(document).ready( function () {
    var table = $('#warehouse-stock-table').DataTable();
 
    table.on( 'draw', function () {
        var body = $( table.table().body() );
 
        body.unhighlight();
        body.highlight( table.search() );  
    } );
} );
</script>
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
