@extends('layouts.admin')
@section('title', 'Create Template')
@section('content')
<a href="{{ route('admin.templates.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.templates.store') }}" method="post" id="create-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Template Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="content">Template Content</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
    </div>
</form>
@endsection
@section('form_nav')
<div class="text-right">
    <a class="btn btn-success" onclick="event.preventDefault();$('#create-form').submit();">Create new Template</a>
</div>
@endsection