@extends('layouts.admin')
@section('title', 'Confirm events upload')
@section('content')
<a href="{{ route('admin.events.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<p>Confirm that these events match the file. This will overwrite the current database. If some valid data does not appear correctly ensure the following format:</p>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Field</th>
                <th>Accepted input format</th>
                <th>Required?</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name</td>
                <td>text</td>
                <td>Yes</td>
                <td>The name of the event</td>
            </tr>
            <tr>
                <td>Start date</td>
                <td>yyyy-MM-dd</td>
                <td>Yes</td>
                <td>Start date of the event</td>
            </tr>
            <tr>
                <td>End date</td>
                <td>yyyy-MM-dd</td>
                <td>No</td>
                <td>End date of the event, if not provided then 1 day event is assumed</td>
            </tr>
            <tr>
                <td>Start/End time</td>
                <td>hh:mm:ss OR hh:mm</td>
                <td>No</td>
                <td>The start and end times of the event</td>
            </tr>
            <tr>
                <td>Notes</td>
                <td>text</td>
                <td>No</td>
                <td>A quick description of the event</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
@section('table')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Start time</th>
                <th>End time</th>
                <th>Notes</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <form action="{{ route('admin.events.batchUpload') }}" method="post" id="event-batch-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach ($events as $index => $event)
            <tr>
                <td>&#35;{{ $index + 1 }}</td>
                <td><input type="text" name="events[{{ $index }}][name]" id="events[{{ $index }}][name]" value="{{ $event->name }}"></td>
                <td><input type="date" name="events[{{ $index }}][start_date]" id="events[{{ $index }}][start_date]" value="{{ $event->start_date }}"></td>
                <td><input type="date" name="events[{{ $index }}][end_date]" id="events[{{ $index }}][end_date]" value="{{ $event->end_date }}"></td>
                <td><input type="time" name="events[{{ $index }}][start_time]" id="events[{{ $index }}][start_time]" value="{{ $event->start_time }}"></td>
                <td><input type="time" name="events[{{ $index }}][end_time]" id="events[{{ $index }}][end_time]" value="{{ $event->end_time }}"></td>
                <td><input type="text" name="events[{{ $index }}][notes]" id="events[{{ $index }}][notes]" value="{{ $event->notes }}"></td>
                <td><button onclick="deleteRow(this, event)" class="btn btn-default"><span class="fa fa-times"></span></button></td>
            </tr>
        @endforeach
        </form>
        <tbody>
    </table>
</div>
@endsection
@section('form_nav')
<div class="text-right">
    <a class="btn btn-success" onclick="confirmOverwrite(event, '#event-batch-form', '', function(event, formID, selector) {$(formID).submit();})">Confirm</a>
</div>
@endsection