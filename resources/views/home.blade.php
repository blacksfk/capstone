@extends('layouts.master')
@section('title', 'Welcome')
@section('content')

<div id="features-sec" class="container set-pad">
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
        </div>
    </div>
</div>
@endsection