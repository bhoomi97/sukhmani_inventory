<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sukhmani</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background: url("about-img1.jpg") no-repeat center center fixed;
                background-size: cover;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 30px;
            }

            .links > a {
                color: white;
                background-color: rgba(158, 158, 158, 0.8);
                border-radius: 6px;
                margin-right: 4px;
                padding: 0.5rem 1rem;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
                background-color: rgba(158, 158, 158, 0.8);
                padding: 1rem 10rem;
                color: white;
                border-radius: 6px;

            }
            hr{
               width: 30%;
               height: 5px;
               margin: -1rem auto;
               background-color: white;
               color: white;
               border: none; 
               border-radius: 4px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
              
                <div class="title m-b-md">
                   <h1 class="h1-responsive" align="center">eStock</h1>
                   <hr>
                   <h4 class="h4-responsive" align="center">Sukhmani<br>BuildWell</h4>
                </div>
             
            </div>
          
        </div>
    </body>
</html>
