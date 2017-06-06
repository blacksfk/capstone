@extends('layouts.admin')
@section('title', 'Edit ' . $link->name)
@section('content')
<a href="{{ route('admin.links.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.links.destroy', $link->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<form action="{{ route('admin.links.update', $link->id) }}" method="post" id="edit-form">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Link name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $link->name }}">
    </div>
    @if (isset($link->page) || count($link->children))
        <label for="active">Active</label>
        <div class="form-group">
            <input type="radio" name="active" value=1 @if ($link->active) checked @endif> Enabled <br>
            <input type="radio" name="active" value=0 @if (!$link->active) checked @endif> Disabled
        </div>
    @else
        <input type="hidden" name="active" value="0">
    @endif
    <div class="form-group">
        <label for="parent_id">Parent link</label>
        <select name="parent_id" id="parent_id" class="form-control">
            @if (!empty($link->parent_id))
                <option value="{{ $link->parent_id }}" selected>{{ $link->parent->name }}</option>
            @endif
            <option value="">None</option>
            @foreach ($links as $parent)
                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
            @endforeach
        </select>
    </div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.links.destroy', $link->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form', '{{ $link->name }}')">Delete {{ $link->name }}</a>
<a class="btn btn-success pull-right" onclick="event.preventDefault();$('#edit-form').submit();">Update {{ $link->name }}</a>
@endsection