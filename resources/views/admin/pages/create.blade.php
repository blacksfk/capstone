@extends('layouts.admin')
@section('title', 'Create new Page')
@section('content')
<div class="form-group">
    {{ Form::model(null, ['method' => 'POST', 'route' => ['admin.pages.store', null]]) }}
        @include('admin.pages.form')
        {{ Form::submit('Create', ['class' => 'form-control btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection