<html>
<head>
    <title>Elastic Search Implementation</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <style>
        .center {
            text-align: center;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="center">
                @yield('logo')
            </div>
        </div>
    </div>
    @yield('content')
</div>
<footer>
    <hr>
    <br>
    <div class="center">
        &copy; de wikidumpers
    </div>
    <br>
    <br>
    <br>
</footer>
</body>
</html>