<div class="background-nav">
    <nav class="navbar navbar-inverse" id="menu">
        <div>
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
                {{-- Dynamic links go here!! --}}
            @foreach ($dynLinks as $link)
                @if ($link->getChildren()->count())
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">{{ strtoupper($link->getLink()->name) }}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        @foreach ($link->getChildren() as $child)
                            <li><a href="{{ strtolower(url($child->name)) }}">{{ $child->name }}</a></li>
                        @endforeach
                        </ul>
                    </li>
                @else
                    <li><a href="{{ strtolower(url($link->getLink()->name)) }}">{{ strtoupper($link->getLink()->name) }}</a></li>
                @endif
            @endforeach
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                @elseif (Auth::user()->is_admin)
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">ADMINISTRATION<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.assets.index') }}">Asset managment</a></li>
                            <li><a href="{{ route('admin.backups.index') }}">Backup and Restore</a></li>
                            <li><a href="{{ route('admin.carousel.index') }}">Carousel management</a></li>
                            <li><a href="{{ route('admin.events.index') }}">Event management</a></li>
                            <li><a href="{{ route('admin.links.index') }}">Link management</a></li>
                            <li><a href="{{ route('admin.pages.index') }}">Page management</a></li>
                            <li><a href="{{ route('admin.users.index') }}">User management</a></li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user())
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