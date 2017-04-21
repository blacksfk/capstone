<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
</head>
<body>
    @include('shared.navbar')
    @include('shared.carousel')
    <div  class="tag-line" >
        <div class="container">
            <div class="row  text-center" >
                <div class="col-lg-12  col-md-12 col-sm-12">      
                    <h2>
                        <i class="fa fa-circle-o-notch"></i>
                        @yield('title')
                        <i class="fa fa-circle-o-notch"></i>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="padded-sides">
        @yield('content')
    </div>

    @include('shared.footer')

    <!--  Jquery Core Script -->
    <!--  Core Bootstrap Script -->
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <!--  Flexslider Scripts --> 
    <script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
    <!--  Scrolling Reveal Script -->
    <script src="{{ asset('assets/js/scrollReveal.js') }}"></script>
    <!--  Scroll Scripts --> 
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <!--  Custom Scripts --> 
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>