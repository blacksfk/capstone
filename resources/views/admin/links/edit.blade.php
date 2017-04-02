@extends('layouts.admin')
@section('title', 'Edit ' . $link->id)
@section('content')
<div class="form-group">
    {{ Form::model($link, ['method' => 'DELETE', 'route' => ['admin.links.destroy', $link->id]]) }}
        {{ Form::submit('Delete ' . $link->name, ['class' => 'form-control btn btn-danger']) }}
    {{ Form::close() }}

    {{ Form::model($link, ['method' => 'PATCH', 'route' => ['admin.links.update', $link->id]]) }}
        @include('admin.links.form')
        {{ Form::submit('Save', ['class' => 'form-control btn btn-success']) }}
    {{ Form::close() }}
</div>
@endsection