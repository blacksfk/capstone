@extends('layouts.admin_form')
@section('title', 'Create new Event')
@section('back_link', route('admin.events.index'))
@section('content')
<form action="{{ route('admin.events.store') }}" method="post">
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
    <input type="submit" value="Create new Event" class="btn btn-success">
</form>
@endsection