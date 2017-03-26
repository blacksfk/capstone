@extends('layouts.master')
@section('title', 'Events')
@section('content')

<div id="features-sec" class="container set-pad" >
    <div class="row text-center">
        <h1 class="header-line">Events</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Notes</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection