@extends('layouts.master')
@section('title', 'Welcome')
@section('content')

    <div id="features-sec" class="set-pad" >
        <div class="row text-center">
            
				<object width="75%" height="900px" data="{{ asset('assets/pdf/canteen2017.pdf') }}"></object>
            
        </div>
    </div>
@endsection