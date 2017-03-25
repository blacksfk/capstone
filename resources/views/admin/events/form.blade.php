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