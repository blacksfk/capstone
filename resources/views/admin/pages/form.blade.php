{{ Form::token() }}
{{ Form::label('name', 'Name') }}
{{ Form::text('name', null, ['class' => 'form-control']) }}
{{ Form::label('category', 'Category') }}
{{ Form::select('category', null, ['class' => 'form-control']) }}
{{ Form::label('content', 'Content') }}
{{ Form::textarea('content', null, ['class' => 'form-control']) }}