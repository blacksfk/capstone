<div class="background-nav">
    <nav class="navbar navbar-inverse" id="menu">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span>MENU</span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/img/primary_logo.png') }}" width="100px" height="40px" alt="school logo"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">HOME<span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ABOUT US<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/about/principal') }}">Principal</a></li>
                            <li><a href="{{ url('/about/history') }}">History</a></li>
                            <li><a href="{{ url('/about/policies') }}">Policies</a></li>
                        </ul>
                    </li>
{{--                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CURRICULUM<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/curriculum/literacy') }}">Literacy</a></li>
                            <li><a href="{{ url('/curriculum/numeracy') }}">Numeracy</a></li>
                        </ul>
                    </li> --}}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DIGITAL TECH<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/digital-tech/multimedia') }}">Multimedia</a></li>
                            <li><a href="{{ url('/digital-tech/esmart') }}">eSmart</a></li>
                            <li><a href="{{ url('/digital-tech/tms') }}">The Morning Show</a></li>
                            
                        </ul>
                    </li>
                    <li><a href="{{ url('/enrolment') }}">ENROLMENT</a></li>
                    <li><a href="{{ url('parents-info') }}">PARENTS INFO</a></li>
                    <li><a href="{{ url('events') }}">EVENTS</a></li>
                    <li><a href="{{ url('contact') }}">CONTACT US</a></li>
                {{-- Dynamic links go here!! --}}
            @foreach ($dynLinks as $link)
                @if ($link->getChildren()->count())
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">{{ strtoupper($link->getLink()->name) }}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                    @foreach ($link->getChildren() as $child)
                            <li><a href="{{ url($child->page->name) }}">{{ strtoupper($child->page->name) }}</a></li>
                    @endforeach
                        </ul>
                    </li>
                @else
                    <li><a href="{{ url($link->getLink()->page->name) }}">{{ strtoupper($link->getLink()->page->name) }}</a></li>
                @endif
            @endforeach
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">ADMINISTRATION<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.assets.index') }}">Asset managment</a></li>
                            <li><a href="{{ route('admin.events.index') }}">Event management</a></li>
                            <li><a href="{{ route('admin.links.index') }}">Link management</a></li>
                            <li><a href="{{ route('admin.pages.index') }}">Page management</a></li>
                            <li><a href="{{ route('admin.templates.index') }}">Template management</a></li>
                            <li><a href="{{ route('admin.newsletter.index') }}">Newsletter Management</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">LOGOUT</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
<noscript>
    <meta http-equiv="refresh" content="0;{{ url('noscript') }}">
    <!--<h1 class="text-center" style="color:red;" >TURN ON JAVASCRIPT OR GTFO </h1> -->
</noscript>