@extends('layouts.admin')
@section('title', 'Confirm events upload')
@section('content')
<a href="{{ route('admin.events.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<p>Confirm that these events match the file. If some valid data does not appear correctly ensure the following format:</p>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Field</th>
                <th>Accepted input format</th>
                <th>Required?</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name</td>
                <td>text</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>yyyy-MM-dd</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Start/End time</td>
                <td>hh:mm:ss OR hh:mm</td>
                <td>No</td>
            </tr>
            <tr>
                <td>Notes</td>
                <td>text</td>
                <td>No</td>
            </tr>
        </tbody>
    </table>
</div>
<form action="{{ route('admin.events.batchUpload') }}" method="post" id="event-batch-form" class="hiddenForm">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
@endsection
@section('table')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Date</th>
                <th>Start time</th>
                <th>End time</th>
                <th>Notes</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($events as $index => $event)
            <tr>
                <td>&#35;{{ $index + 1 }}</td>
                <td><input type="text" name="events[{{ $index }}][name]" id="events[{{ $index }}][name]" value="{{ $event->name }}"></td>
                <td><input type="date" name="events[{{ $index }}][date]" id="events[{{ $index }}][date]" value="{{ $event->date }}"></td>
                <td><input type="time" name="events[{{ $index }}][start_time]" id="events[{{ $index }}][start_time]" value="{{ $event->start_time }}"></td>
                <td><input type="time" name="events[{{ $index }}][end_time]" id="events[{{ $index }}][end_time]" value="{{ $event->end_time }}"></td>
                <td><input type="text" name="events[{{ $index }}][notes]" id="events[{{ $index }}][notes]" value="{{ $event->notes }}"></td>
                <td><button type="button" class="close" onclick="deleteRow(this, event)">&times;</button></td>
            </tr>
        @endforeach
        <tbody>
    </table>
</div>
@endsection
@section('form_nav')
<div class="text-right">
    <a class="btn btn-success" onclick="confirmOverwrite(event, '#event-batch-form', appendToForm, 'td > input')">Confirm</a>
</div>
@endsection