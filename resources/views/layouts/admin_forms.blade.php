@extends('layouts.admin')
@section('content')
<div class="pull-left">
    <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-primary">Back</a>
</div>
@yield('form')
@endsection