{{ Form::token() }}
{{ Form::label('name', 'Name') }}
{{ Form::text('name', ['class' => 'form-control']) }}
{{ Form::label('status', 'Status') }}
{{ Form::select('status', [0 => 'Disabled', 1 => 'Enabled'], 0, ['class' => 'form-control']) }}
{{ Form::label('parent', 'Parent') }}
{{ Form::select('parent', ["test" => "lol", "test2" => "rofl"], null, ['class' => 'form-control']) }}