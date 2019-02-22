<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/sky-icon.png')}}">
    <title>IQAS | SkyLogistics Internal Quality Audit System</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ url('css/style.css')}}" rel="stylesheet">
    <!-- page css -->
    <link href="{{ url('css/error-pages.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ url('css/css/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
    @yield('content')

    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/waves.js')}}"></script>
</body>

</html>