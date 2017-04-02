@extends('layouts.admin')
@section('title', 'Create new Link')
@section('content')
<div class="form-group">
    {{ Form::model(null, ['method' => 'POST', 'route' => ['admin.links.store', null]]) }}
        @include('admin.links.form')
        {{ Form::submit('Create', ['class' => 'form-control btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection