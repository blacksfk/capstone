@extends('layouts.admin')
@section('title', 'Create new image')
@section('content')
	<div class="form-group">
		<form class="well" method="post" action="">
			@include('admin.gallery.form')
		</form>
	</div>
@endsection