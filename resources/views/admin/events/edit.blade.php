@extends('layouts.admin')
@section('title', 'Edit ' . $event->name)
@section('back_link', route('admin.events.index'))
@section('content')
<form action="{{ route('admin.events.destroy', $event->id) }}" method="post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="Delete {{ $event->name }}" class="btn btn-danger">
</form>
<form action="{{ route('admin.events.update', $event->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}">
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control"  value="{{ $event->date }}">
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
    <input type="submit" value="Update {{ $event->name }}" class="btn btn-success">
</form>
@endsection