@extends('layouts.master')
@section('title', 'Events')
@section('content')

<div id="features-sec" class="container set-pad" >
    <div class="row text-center">
        <h1 class="header-line">Events</h1>
        <table class="table table-hover template_table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->end_time }}</td>
                        <td>{{ $event->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection