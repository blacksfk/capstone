@extends('layouts.admin')
@section('title', 'Edit ' . $gallerycategory->name)
@section('content')
<form action="{{ route('admin.gallerycategories.destroy', $gallerycategories->id) }}" method="post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="Delete {{ $gallerycategories->name }}" class="btn btn-danger">
</form>
<form action="{{ route('admin.gallerycategories.update', $gallerycategories->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $gallerycategories->name }}">
    </div>
    <input type="submit" value="Update {{ $gallerycategories->name }}" class="btn btn-success">
</form>
@endsection