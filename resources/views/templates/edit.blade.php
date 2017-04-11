@extends('layouts.admin_form')
@section('title', 'Editing ' . $template->name)
@section('content')
<form action="{{ route('admin.templates.destroy', $template->id) }}" method="post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="Delete {{ $template->name }}" class="btn btn-danger">
</form>
<form action="{{ route('admin.templates.update', $template->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group"><label for="name">Template Name</label><input type="text" name="name" id="name" value="{{ $tempate->name }}" class="form-control"></div>
    <div class="form-group"><label for="content">Template Content</label><textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $template->content }}</textarea></div>
    <input type="submit" value="Update {{ $template->name }}" class="btn btn-success">
</form>
@endsection