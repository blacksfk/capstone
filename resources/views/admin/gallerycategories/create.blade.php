@extends('layouts.admin')
@section('title', 'Create new gallery category')
@section('content')
<form action="{{ route('admin.gallerycategory.store') }}" method="post">
    <label class="form-control">New category name : </label>
	<input class="form-control" type="text" name="name" id="name">
    <input type="submit" value="Create new category" class="btn btn-success">
</form>
@endsection