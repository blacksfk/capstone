@extends('layouts.admin')
@section('title', 'Editing ' . $template->name)
@section('back_link', route('admin.templates.index'))
@section('content')
<a href="{{ route('admin.templates.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.templates.destroy', $template->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="record" value="{{ $template->name }}">
</form>
<form action="{{ route('admin.templates.update', $template->id) }}" method="post" id="edit-form">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Template Name</label>
        <input type="text" name="name" id="name" value="{{ $template->name }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="content">Template Content</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control" readonly>{{ $template->content }}</textarea>
    </div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.templates.destroy', $template->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form')">Delete {{ $template->name }}</a>
<a class="btn btn-success pull-right" onclick="event.preventDefault();$('#edit-form').submit();">Update {{ $template->name }}</a>
@endsection