@extends('layouts.admin_form')
@section('title', 'Edit ' . $link->name)
@section('form')
<form action="{{ route('admin.links.destroy', $link->id) }}" method="post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="Delete {{ $link->name }}" class="btn btn-danger">
</form>
<form action="{{ route('admin.links.update', $link->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Link name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $link->name }}">
    </div>
    <label for="active">Active</label>
    <div class="form-group">
            <input type="radio" name="active" value=1 @if ($link->active) checked @endif> Enabled <br>
            <input type="radio" name="active" value=0 @if (!$link->active) checked @endif> Disabled
    </div>
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
    <input type="submit" value="Update {{ $link->name }}" class="btn btn-success">
</form>
@endsection