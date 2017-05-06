@extends('layouts.admin')
@section('title', 'Create Template')
@section('back_link', route('admin.templates.index'))
@section('content')
<form action="{{ route('admin.templates.store') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Template Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="content">Template Content</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <input type="submit" value="Create new Template" class="btn btn-success">
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.templates.index') }}" class="btn btn-warning">Cancel</a>
@endsection