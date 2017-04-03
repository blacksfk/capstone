@extends('layouts.master')
@section('title', 'Welcome')
@section('content')
    <div class="row text-center">
        {{var_dump($request) }}
        <br>
        <div> Click the button below to be redirected to the new site. <br>
        <button type="button" class="btn btn-secondary"> <a href="{{ url('/test2') }}">Created Site</a> </button>
        </div>
    </div>
@endsection