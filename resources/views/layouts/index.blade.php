<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eSalon</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/half-slider.css')}}" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
@include('partials.nav')
@if(session('status'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert" style="position:fixed; z-index: 99999; left:40%;">
        {{ session()->get('status')}}
    </div>
@endif
@yield('content')

@include('partials.footer')

</body>

</html>
