<div class="navbar navbar-inverse navbar-fixed-top " id="menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span>MENU</span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"><img class="logo-custom" src="{{asset('assets/img/primary_logo.png')}}"></a>
        </div>
        <div class="navbar-collapse collapse move-me">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-toggle sliding-middle-out">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        CURRICULUM<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/curriculum/literacy') }}">Literacy</a></li>
                        <li><a href="{{ url('/curriculum/numeracy') }}">Numeracy</a></li>
                        <li><a href="{{ url('/curriculum/digital_technologies') }}">Digital Technologies</a></li>
                    </ul>
                </li>
                
                <li class="sliding-middle-out">
                    <a href="{{ url('events') }}">EVENTS</a>
                </li>
                <li class="dropdown dropdown-toggle sliding-middle-out">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
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
                    <a href="{{ url('contact') }}">CONTACT US</a>
                </li>

                {{-- Dynamic links go here!! --}}
                @foreach ($dynLinks as $category => $links)
                    @if (count($links) > 0)
                        <li class="dropdown dropdown-toggle sliding-middle-out">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {{ strtoupper($category) }}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach ($links as $link)
                                    <li><a href="{{ url($link->page->name) }}">
                                        {{ $link->page->name }}
                                    </a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="slidiing-middle-out">
                            <a href="{{ url($category) }}">
                                {{ strtoupper($category) }}
                            </a>
                        </li>
                    @endif
                @endforeach
                {{-- End dynamic links --}}

                <li class="sliding-middle-out">
                    <a href="{{ url('admin') }}">ADMIN</a>
                </li>
            </ul>
        </div>
    </div>
</div>