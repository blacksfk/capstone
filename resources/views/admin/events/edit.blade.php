@extends('layouts.admin')
@section('title', 'Edit ' . $event->name)
@section('content')
<a href="{{ route('admin.events.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.events.destroy', $event->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<form action="{{ route('admin.events.update', $event->id) }}" method="post" id="edit-form">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}">
    </div>
    <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control"  value="{{ $event->start_date }}">
    </div>
    <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control"  value="{{ $event->end_date }}">
    </div>
    <div class="form-group">
        <label for="start_time">Start time</label>
        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $event->start_time }}">
    </div>
    <div class="form-group">
        <label for="end_time">End time</label>
        <input type="time" name="end_time" id="end_time" class="form-control"  value="{{ $event->end_time }}">
    </div>
    <div class="form-group">
        <label for="notes">Notes</label>
        <textarea name="notes" id="notes" class="form-control">{{ $event->notes }}</textarea>
    </div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.events.destroy', $event->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form', '{{ $event->name }}')">Delete {{ $event->name }}</a>
<a class="btn btn-success pull-right" onclick="event.preventDefault();$('#edit-form').submit();">Update {{ $event->name }}</a>
@endsection