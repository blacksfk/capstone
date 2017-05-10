@extends('layouts.admin')
@section('title', 'Edit Events')
@section('content')
<a href="{{ route('admin.events.create') }}" class="btn btn-info">Create new Event</a>
<a href="{{ route('admin.events.uploadFile') }}" class="btn btn-info">Batch Upload from CSV</a>
@endsection
@section('table')
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Start time</th>
            <th>End time</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->start_time }}</td>
                <td>{{ $event->end_time }}</td>
                <td>{{ $event->notes }}</td>
                <td><a href="{{ route('admin.events.edit', $event->id) }}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection