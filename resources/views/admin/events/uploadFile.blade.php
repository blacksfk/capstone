@extends('layouts.admin')
@section('title', 'Upload Events from file')
@section('content')
<a href="{{ route('admin.events.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.events.previewFile') }}" method="post" enctype="multipart/form-data" id="upload-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="events">Select file</label>
        <input type="file" name="events" id="events">
    </div>
</form>
@endsection
@section('form_nav')
<div class="text-right">
    <a class="btn btn-success" onclick="event.preventDefault();$('#upload-form').submit();">Upload file</a>
</div>
@endsection