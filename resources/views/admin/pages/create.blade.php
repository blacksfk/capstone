@extends('layouts.admin')
@section('title', 'Create new Page')
@section('back_link', route('admin.pages.index'))
@section('content')
<a href="{{ route('admin.pages.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.pages.store') }}" method="post" id="create-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="link_id">Link</label>
        <select name="link_id" id="link_id" class="form-control">
            <option value="">None</option>
            @foreach ($links as $link)
                <option value="{{ $link->id }}">{{ $link->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" cols="30" rows="10" class="form-control" id="content"></textarea>
    </div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.pages.preview') }}" class="btn btn-primary" onclick="previewPage(this, event)">Preview</a>
<a class="btn btn-success pull-right" onclick="event.preventDefault();$('#create-form').submit();">Create new Page</a>
@endsection