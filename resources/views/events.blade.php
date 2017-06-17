@extends('layouts.master')
@section('title', 'Events')
@section('content')
<div id="features-sec" class="container set-pad">
    <div class="row text-center"><h1 class="header-line">Click on the event name to add it to your Google Calendar!</h1></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#" onclick="showEvents(this, event, '.events-week', ['.events-month', '.events-year'])">This Week</a></li>
                    <li role="presentation"><a href="#" onclick="showEvents(this, event, '.events-month', ['.events-week', '.events-year'])">{{ $carbon->format("F") }}</a></li>
                    <li role="presentation"><a href="#" onclick="showEvents(this, event, '.events-year', ['.events-week', '.events-month'])">{{ $carbon->format("Y") }}</a></li>
                </ul>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="sortable">Date&nbsp;<span class="fa fa-sort"></span></th>
                                <th>Day</th>
                                <th class="sortable">Name&nbsp;<span class="fa fa-sort"></span></th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody class="events-week">
                        @foreach ($week as $event)
                            <tr>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->getDay() }}</td>
                                <td><a href="{{ $event->getGoogleLink() }}">{{ $event->name }}</a></td>
                                <td>{{ $event->start_time }}</td>
                                <td>{{ $event->end_time }}</td>
                                <td>{{ $event->notes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tbody class="events-month" style="display: none">
                        @foreach ($month as $event)
                            <tr>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->getDay() }}</td>
                                <td><a href="{{ $event->getGoogleLink() }}">{{ $event->name }}</a></td>
                                <td>{{ $event->start_time }}</td>
                                <td>{{ $event->end_time }}</td>
                                <td>{{ $event->notes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tbody class="events-year" style="display: none">
                        @foreach ($year as $event)
                            <tr>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->getDay() }}</td>
                                <td><a href="{{ $event->getGoogleLink() }}">{{ $event->name }}</a></td>
                                <td>{{ $event->start_time }}</td>
                                <td>{{ $event->end_time }}</td>
                                <td>{{ $event->notes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection