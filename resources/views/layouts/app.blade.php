<!doctype  html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name','ST Laravel')}}</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="https://​cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://​cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div id="app">
        <div class="main">
            @yield('content')
        </div>
    </div>
</body>
</html>


