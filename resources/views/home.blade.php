@extends('layouts.master')
@section('title', 'Welcome')
@section('content')

    <div id="features-sec" class="set-pad" >
        <div class="row text-center">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                <h2>Welcome to Courtenay Gardens Primary School, the best school in the state!</h2>
                <br>
                <p>
                    Courtenay Gardens Primary School is committed to ensuring that all children have fostered in them qualities and skills which will enable them to adapt to change and be lifelong learners.
                </p>
                <br>

                <div class="row">
                  <div class="col-sm-4">
                    <div class="card panel panel-default">
                      <div class="card-block panel-body">
                        <h3 class="card-title">About Us</h3>
                        <p class="card-text">Wish to know more about our history?</p>
                        <a href="{{ url('/about/history') }}" class="btn btn-primary">Click here</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card panel panel-default">
                      <div class="card-block panel-body">
                        <h3 class="card-title">Events</h3>
                        <p class="card-text">Wish to know what's happening in CGPS?</p>
                        <a href="{{ url('/events') }}" class="btn btn-primary">Click here</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card panel panel-default">
                      <div class="card-block panel-body">
                        <h3 class="card-title">Contact Us</h3>
                        <p class="card-text">Wish to enquire more about CGPS?</p>
                        <a href="{{ url('/contact') }}" class="btn btn-primary">Click here</a>
                      </div>
                    </div>
                  </div>
                </div>
{{--                 <h1 class="header-line">FEATURES INCLUDE</h1>
                <ul class="list-group">
                  <li class="list-group-item">Grade sizes kept to a minimum</li>
                  <li class="list-group-item">Straight grades (where possible)</li>
                  <li class="list-group-item">Modern, well equipped school</li>
                  <li class="list-group-item">Positive attitude to the wearing of our compulsory school uniform</li>
                  <li class="list-group-item">A clean tar code of coduct</li>
                  <li class="list-group-item">High academic standards</li>
                  <li class="list-group-item">Safe, secure environment</li>
                </ul>

                <h1 class="header-line">FACILITIES INCLUDE</h1>
                <ul class="list-group">
                  <li class="list-group-item">Attractive grounds and gardens</li>
                  <li class="list-group-item">Substantial shade areas</li>
                  <li class="list-group-item">Grade level adventure playgrounds</li>
                  <li class="list-group-item">Prep rotunda</li>
                  <li class="list-group-item">Two hard-court areas and a large oval</li>
                  <li class="list-group-item">Fully serviced canteen</li>
                  <li class="list-group-item">Two computer labs with modern equipment</li>
                </ul> --}}
                

                {{-- <h1 class="header-line">GALLERY</h1>


                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                        </a>
                    </div> --}}


                </div>
            </div>
        </div>
    </div>
@endsection