<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    @include('shared.head')
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
    @include('shared.scripts')
</body>

</html>