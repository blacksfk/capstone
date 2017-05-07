@extends('layouts.admin')
@section('title', 'Editing ' . $template->name)
@section('back_link', route('admin.templates.index'))
@section('content')
<form action="{{ route('admin.templates.destroy', $template->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="record" value="{{ $template->name }}">
</form>
<form action="{{ route('admin.templates.update', $template->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group"><label for="name">Template Name</label><input type="text" name="name" id="name" value="{{ $template->name }}" class="form-control"></div>
    <div class="form-group"><label for="content">Template Content</label><textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $template->content }}</textarea></div>
    <input type="submit" value="Update {{ $template->name }}" class="btn btn-success center-block">
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.templates.index') }}" class="btn btn-warning">Cancel</a>
<a href="{{ route('admin.templates.destroy', $template->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form')">Delete {{ $template->name }}</a>
@endsection