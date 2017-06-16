<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" /> 
<meta name="description" content="" />
<meta name="author" content="" />
<noscript>
    <meta http-equiv="refresh" content="0;{{ url('noscript') }}">
</noscript>
<title>@yield('title')</title>
<!-- BOOTSTRAP CORE STYLE CSS -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- FONT AWESOME CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<!-- CUSTOM STYLE CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">   
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- CSRF token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>