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
                    <li class="dropdown dropdown-toggle">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">CURRICULUM
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/curriculum/literacy') }}">Literacy</a></li>
                                <li><a href="{{ url('/curriculum/numeracy') }}">Numeracy</a></li>
                                <li><a href="{{ url('digital_technologies') }}">Digital Technologies</a></li>
                            </ul></li>
                            <li><a href="{{ url('events') }}">EVENTS</a></li>
                            <li class="dropdown dropdown-toggle">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">GET INVOLVED
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('kids') }}">For Kids</a></li>
                                    <li><a href="{{ url('parents') }}">For Parents</a></li>
                                    <li><a href="{{ url('teachers') }}">For Teachers</a></li>
                                </ul></li>
                            <li><a href="{{ url('contact') }}">CONTACT US</a></li>
            </ul>
        </div>
    </div>
</div>