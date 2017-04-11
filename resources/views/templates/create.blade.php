@extends('layouts.admin_form')
@section('title', 'Create Template')
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