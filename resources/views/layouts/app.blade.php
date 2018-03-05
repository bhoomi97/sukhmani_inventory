<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark unique-color-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="padding-top: 4px;">
                    <img src="{{ URL::to('logo.jpg') }}" height="40px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a class="nav-link" href="{{ route('home') }}">Dashboard</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Manage <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('warehouseInventory') }}">
                                        WareHouse Stock
                                    </a>
                                    <a class="dropdown-item" href="{{ route('siteInventory') }}">
                                        Move To Site
                                    </a>
                                    @if(Auth::user()->role ==1)
                                        <a class="dropdown-item" href="{{ route('site.index') }}">
                                            Manage Sites
                                        </a>
                                    @endif
                                </div>
                            </li>
                            @if(Auth::user()->role ==1)
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Generate Report <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('warehouseStock') }}">
                                            WareHouse
                                        </a>
                                        <a class="dropdown-item" href="{{ route('site.index') }}">
                                            Site Report
                                        </a>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout ({{ Auth::user()->name }})
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> 

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>
            
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="{{ asset('js/jquery.table2excel.js') }}"></script>    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $("#export").click(function(){
            date = new Date();
          $("#table2excel").table2excel({
            // exclude CSS class
            exclude: ".noExl",
            name: "Worksheet Name",
            filename: date+".xls" //do not include extension
          }); 
        }); 

        $(document).ready(function() {
            $('.datatable').DataTable();
        });

        $(document).on("click", ".deleteRow", function(){
            $(this).closest('tr').remove();
        });

        $(document).on("keyup", ".costing", function(){
            costing = $(this).val();
            quantity = $(this).closest('tr').find('.quantity').val();
            console.log(costing);
            console.log(quantity);
            $(this).closest('tr').find('.amount').val(costing*quantity);
        });

        $(document).on("keyup", ".quantity", function(){
            quantity = $(this).val();
            costing = $(this).closest('tr').find('.costing').val();
            console.log(costing);
            console.log(quantity);
            $(this).closest('tr').find('.amount').val(costing*quantity);
        });

        $(document).on("change", ".category", function(){
            category = $(this).val();
            c = $(this).closest('tr').attr('count');
            $.ajax({
                type: 'GET',
                url: 'getsubcategory',
                data: {
                    'category' : category,
                    'c' : c
                },
                success: function(data){
                    console.log(data);
                    $("tr[count='"+data[1]+"']").find(".subcategory").html('');
                    data[0].forEach(function(d){
                        $("tr[count='"+data[1]+"']").find(".subcategory").append('<option value='+d.id+'>'+d.subcategory+'</option>');
                        console.log(d);
                    })
                }
            });
        });
        // $(document).on("click", ".dropdown", function(){
        //     wid = $(this).width();
        //     console.log(wid);
        //     $(".dropdown-menu").css("width",wid);
        //     $(".dropdown-menu").css("min-width",wid);
        // });
    </script>
    @yield('script')
</body>
</html>
