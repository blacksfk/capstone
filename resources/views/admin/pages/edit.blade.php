@extends('layouts.admin')
@section('title', 'Edit ' . $page->name)
@section('content')
<a href="{{ route('admin.pages.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.pages.destroy', $page->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<form action="{{ route('admin.pages.update', $page->id) }}" method="post" id="edit-form">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $page->name }}">
    </div>
    <div class="form-group">
        <label for="link_id">Link</label>
        <select name="link_id" id="link_id" class="form-control">
            <option value="">None</option>
            @if (isset($page->link))
                <option value="{{ $page->link_id }}" selected>{{ $page->link->name }}</option>
            @endif
            @foreach ($links as $link)
                <option value="{{ $link->id}}">{{ $link->name }}
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $content }}</textarea>
        </div>
    </div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.pages.destroy', $page->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form', '{{ $page->name }}')">Delete {{ $page->name }}</a>
<a href="{{ route('admin.pages.preview') }}" class="btn btn-primary" onclick="previewPage(this, event)">Preview</a>
<a class="btn btn-success pull-right" onclick="event.preventDefault();$('#edit-form').submit();">Update {{ $page->name }}</a>
@endsection