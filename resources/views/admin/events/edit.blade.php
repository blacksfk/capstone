@extends('layouts.admin')
@section('title', 'Edit ' . $event->id)
@section('content')
<div class="form-group">
    {{-- Delete form --}}
    {{ Form::model($event, ['method' => 'DELETE', 'route' => ['admin.events.destroy', $event]]) }}
        {{ Form::submit('Delete ' . $event->name, ['class' => 'form-control btn btn-danger']) }}
    {{ Form::close() }}

    {{-- Update/edit form --}}
    {{ Form::model($event, ['method' => 'PATCH', 'route' => ['admin.events.update', $event]]) }}
        @include('admin.events.form')
        {{ Form::submit('Save', ['class' => 'form-control btn btn-success']) }}
    {{ Form::close() }}
@endsection