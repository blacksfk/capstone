@extends('layouts.admin')
@section('title', 'Upload Events from file')
@section('content')
<form action="{{ route('admin.events.previewFile') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="events">Select file</label>
        <input type="file" name="events" id="events"></div>
    <input type="submit" value="Upload" class="btn btn-success">
</form>
@endsection
