<!DOCTYPE html>
<html lang="en">
<head>
        <link rel = "stylesheet" type = "text/css" href = "{{url('css/opste.css')}}">
        <link rel = "stylesheet" type = "text/css" href = "{{url('css/background.css')}}">
        
        <title>
            Login
        </title>

        <link rel="stylesheet" href="{{url('css/style.css')}}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    </head>
    
<body id="{{$body_id ?? ''}}">
    <div id="page-container" class="container-fluid">
        <div id="content-wrap">
            @yield('header')
            @yield('content')
        </div>
    @yield('footer')
    </div>
</body>
</html>