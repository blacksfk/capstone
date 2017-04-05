{{ Form::token() }}
{{ Form::label('name', 'Name') }}
{{ Form::text('name', null, ['class' => 'form-control']) }}
{{ Form::label('category', 'Category') }}
{{ Form::select('category', ['lol' => 'test', 'rofl' => 'test2'], null, ['class' => 'form-control', 'placeholder' => 'Select a link to bind to...']) }}
{{ Form::label('status', 'Status') }}
{{ Form::select('status', ['test' => 'test', 'test2' => 'test2'], null, ['class' => 'form-control', 'placeholder' => 'Select a status...']) }}
{{ Form::label('content', 'Content') }}
{{ Form::textarea('content', null, ['class' => 'form-control']) }}