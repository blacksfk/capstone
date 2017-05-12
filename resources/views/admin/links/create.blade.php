@extends('layouts.admin')
@section('title', 'Create new Link')
@section('content')
<a href="{{ route('admin.links.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.links.store') }}" method="post" id="create-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Link name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <input type="hidden" name="active" value=0>
    <div class="form-group">
        <label for="parent">Parent</label>
        <select name="parent_id" id="parent_id" class="form-control">
            <option value="">None</option>
            @foreach ($links as $link)
                <option value="{{ $link->id }}">{{ $link->name }}</option>
            @endforeach
        </select>
    </div>
</form>
@endsection
@section('form_nav')
<div class="text-right">
    <a class="btn btn-success" onclick="event.preventDefault();$('#create-form').submit();">Create new Link</a>
</div>
@endsection