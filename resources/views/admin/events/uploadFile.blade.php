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
<input type="submit" value="Confirm" class="btn btn-success" disabled>
<script>
    $("#upload").click(function(event) {
        event.preventDefault();

        $.post("{{ route('admin.events.previewFile') }}", {events: $("#file").val()}, function(data) {
            
        }, "json");
    })
</script>
@endsection
