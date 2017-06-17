@extends('layouts.admin')
@section('title', 'Edit Events')
@section('content')
<a href="{{ route('admin.events.create') }}" class="btn btn-default">Create new Event</a>
<a href="{{ route('admin.events.uploadFile') }}" class="btn btn-primary">Batch Upload from CSV</a>
@endsection
@section('table')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="sortable">Name <span class="fa fa-sort"></span></th>
                <th class="sortable">Start Date <span class="fa fa-sort"></span></th>
                <th class="sortable">End Date <span class="fa fa-sort"></span></th>
                <th class="sortable">Start time <span class="fa fa-sort"></span></th>
                <th class="sortable">End time <span class="fa fa-sort"></span></th>
                <th class="sortable">Notes <span class="fa fa-sort"></span></th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->start_date }}</td>
                <td>{{ $event->end_date }}</td>
                <td>{{ $event->start_time }}</td>
                <td>{{ $event->end_time }}</td>
                <td>{{ $event->notes }}</td>
                <td><a href="{{ route('admin.events.edit', $event->id) }}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection