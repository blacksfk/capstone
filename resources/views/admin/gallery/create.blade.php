@extends('layouts.admin')
@section('title', 'Create new image')
@section('content')
	<div class="form-group">
		<form class="well" method="post" action="">
			<label class="form-group">Category : </label><br>
			<select>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
			<label class="form-group">Select images : </label><br>
			<input type="file" name="images"><br>
			<input type="submit" class="btn btn-success btn-send" value="Save">
		</form>
	</div>
@endsection