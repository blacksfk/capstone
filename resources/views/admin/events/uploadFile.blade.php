@extends('layouts.admin')
@section('title', 'Upload Events from file')
@section('content')
<div class="form-group">
    <label for="file">File</label>
    <input type="file" name="file" id="file">
    <input type="submit" value="Upload" class="btn btn-primary">
</div>
<hr>
<table class="table table-hover">
    <thead>
        <th>No.</th>
        <th>Name</th>
        <th>Date</th>
        <th>Start time</th>
        <th>End time</th>
        <th>Notes</th>
    </thead>
</table>
<a href="{{ route('admin.events.batchUpload') }}" class="btn btn-success" disabled>Confirm</a>