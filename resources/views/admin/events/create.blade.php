@extends('layouts.admin')
@section('title', 'Create new Event')
@section('content')
<a href="{{ route('admin.events.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.events.store') }}" method="post" id="create-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control"></div>
    <div class="form-group">
        <label for="start_time">Start time</label>
        <input type="time" name="start_time" id="start_time" class="form-control">
    </div>
    <div class="form-group">
        <label for="end_time">End time</label>
        <input type="time" name="end_time" id="end_time" class="form-control">
    </div>
    <div class="form-group">
        <label for="notes">Notes</label>
        <textarea name="notes" id="notes" class="form-control"></textarea>
    </div>
</form>
@endsection
@section('form_nav')
<div class="text-right">
    <a class="btn btn-success" onclick="event.preventDefault();$('#create-form').submit();">Create new Event</a>
</div>
@endsection