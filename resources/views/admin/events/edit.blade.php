@extends('layouts.admin')
@section('title', 'Edit ' . $event->id)
@section('content')
<div id="features-sec" class="container set-pad">
    <div class="row text-center">
        <div class="form-group">
        <div class="col-xs-12">
            {{ Form::model($event, ['method' => 'PATCH', 'route' => ['admin.events.update', $event]]) }}
                {{ Form::token() }}
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
                {{ Form::label('date', 'Date') }}
                {{ Form::date('date', null, ['class' => 'form-control']) }}
                {{ Form::label('start_time', 'Start time') }}
                {{ Form::text('start_time', null, ['class' => 'form-control']) }}
                {{ Form::label('end_time', 'End time') }}
                {{ Form::text('end_time', null, ['class' => 'form-control']) }}
                {{ Form::label('notes', 'Notes') }}
                {{ Form::textarea('notes', null, ['class' => 'form-control']) }}
                {{ Form::submit('Save', ['class' => 'form-control btn btn-success']) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>
</div>
@endsection