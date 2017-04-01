@extends('layouts.admin')
@section('title', 'Create new Event')
@section('content')
    <div class="form-group">
        {{ Form::model(null, ['method' => 'POST', 'route' => ['admin.events.store', null]]) }}
            @include('admin.events.form')
            {{ Form::submit('Create', ['class' => 'form-control btn btn-success']) }}
        {{ Form::close() }}
    </div>
@endsection