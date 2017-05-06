<meta charset="utf-8" />
<meta name="viewport" content="width=device-width">
<meta name="description" content="" />
<meta name="author" content="" />
<title>@yield('title')</title>
<!-- BOOTSTRAP CORE STYLE CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!-- FONT AWESOME CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<!-- FLEXSLIDER CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/flexslider.css') }}">
<!-- CUSTOM STYLE CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">   
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1GEg7gRkcV2id4F8yoC0TtaW9Ok7jhx4&callback=initMap&libraries=places&cal"
type="text/javascript"></script>

<!-- CSRF token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>