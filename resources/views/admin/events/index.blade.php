@extends('layouts.admin')
@section('title', 'Edit Events')
@section('content')
<div id="features-sec" class="container set-pad">
    @include('shared.sidebar')
    <div class="well row text-center col-lg-offset-3">
        <a href="{{ route('admin.events.create') }}" class="btn btn-info">Create new Event</a>
        <hr>
        <table>
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
                        <td><a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection