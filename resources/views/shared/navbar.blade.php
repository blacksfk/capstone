<div class="background-nav">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span>MENU</span>
        </button>
        <a class="navbar-brand" href="#">CGPS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('home') }}">HOME <span class="sr-only">(current)</span></a></li>
        <li><a href="#">ABOUT US</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CURRICULUM<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/curriculum/literacy') }}">Literacy</a></li>
            <li><a href="{{ url('/curriculum/numeracy') }}">Numeracy</a></li>
            <li><a href="{{ url('/curriculum/digital_technologies') }}">Digital Technologies</a></li>
            <li><a href="{{ url('/curriculum/multimedia') }}">Multimedia</a></li>
            <li><a href="{{ url('/curriculum/esmart') }}">eSmart</a></li>
        </ul>
    </li>
</ul>
<ul class="nav navbar-nav">
    <li><a href="{{ url('events') }}">EVENTS</a></li>
    <li><a href="{{ url('contact') }}">CONTACT US</a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ADMIN<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">Separated link</a></li>
    </ul>
</li>
<li><a href="{{ url('faq') }}">FAQ</a></li>
</ul>
{{-- Dynamic links go here!! --}}
@foreach ($dynLinks as $parent => $child)
{{-- It's not a fucking array it's a fucking collection --}}
@if ($child instanceof Illuminate\Database\Eloquent\Collection)
<li class="dropdown dropdown-toggle sliding-middle-out">
    <a class=" dropdown-toggle" data-toggle="dropdown" href="#">
        {{ strtoupper($parent) }}<span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        @foreach ($child as $link)
        <li><a href="{{ url($link->page->name) }}">
            {{ $link->page->name }}
        </a></li>
        @endforeach
    </ul>
</li>
@else
<li>
    <a href="{{ url($child->page->name) }}">
        {{ strtoupper($child->page->name) }}
    </a>
</li>
@endif
@endforeach
{{-- End dynamic links --}}

<li>
    <a href="{{ url('admin') }}">ADMIN</a>
</li>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
</div>










<!-- <div class="navbar navbar-inverse navbar-fixed-top " id="menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span>MENU</span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"><img class="logo-custom" src="{{asset('assets/img/primary_logo.png')}}"></a>
        </div>
        <div class="navbar-collapse collapse move-me">
            <ul class="nav navbar-right">
                <li class="sliding-middle-out">
                    <a class="navcol" href="{{ url('home') }}">HOME</a>
                </li>
                <li class="dropdown dropdown-toggle sliding-middle-out">
                    <a class="dropdown-toggle navcol" data-toggle="dropdown" href="#">
                        CURRICULUM<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/curriculum/literacy') }}">Literacy</a></li>
                        <li><a href="{{ url('/curriculum/numeracy') }}">Numeracy</a></li>
                        <li><a href="{{ url('/curriculum/digital_technologies') }}">Digital Technologies</a></li>
                        <li><a href="{{ url('/curriculum/multimedia') }}">Multimedia</a></li>
                        <li><a href="{{ url('/curriculum/esmart') }}">eSmart</a></li>

                    </ul>
                </li>
                
                <li class="sliding-middle-out">
                    <a class="navcol" href="{{ url('events') }}">EVENTS</a>
                </li>
                <li class="dropdown dropdown-toggle sliding-middle-out">
                    <a class="dropdown-toggle navcol" data-toggle="dropdown" href="#">
                        GET INVOLVED<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/involve/kids') }}">For Kids</a></li>
                        <li><a href="{{ url('/involve/parents') }}">For Parents</a></li>
                        <li><a href="{{ url('/involve/teachers') }}">For Teachers</a></li>
                        <li><a href="{{ url('/test1') }}">testing controller</a></li>
                    </ul>
                </li>
                <li class="sliding-middle-out">
                    <a class="navcol" href="{{ url('contact') }}">CONTACT US</a>
                </li>





            </ul>
        </div>
    </div>
</div> -->