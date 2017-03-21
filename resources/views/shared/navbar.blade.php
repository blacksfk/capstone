<div class="navbar navbar-inverse navbar-fixed-top " id="menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img class="logo-custom" src="assets/img/logo180-50.png" alt=""  /></a>
        </div>
        <div class="navbar-collapse collapse move-me">
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('') }}">HOME</a></li>
                    <li class="dropdown dropdown-toggle" type="button" data-toggle="dropdown"><a href="{{ url('curriculum') }}">CURRICULUM<span class="caret"></span></a></li>
                        <ul class="dropdown-menu">
                            <li><a href="#">HTML</a></li>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">JavaScript</a></li>
                        </ul>

                    <li><a href="{{ url('events') }}">EVENTS</a></li>
                    <li><a href="{{ url('involve') }}">GET INVOLVED</a></li>
                    <li><a href="{{ url('contact') }}">CONTACT US</a></li>
            </ul>
        </div>
    </div>
</div>