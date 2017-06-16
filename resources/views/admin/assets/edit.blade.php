@extends('layouts.admin')
@section('title', 'Edit ' . $asset->name)
@section('content')
<a href="{{ route('admin.assets.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.assets.destroy', $asset->id) }}" method="post" id ="delete-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="DELETE">
</form>
<form action="{{ route('admin.assets.update', $asset->id) }}" method="post" id="edit-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PATCH">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $asset->name }}" class="form-control">
        <sub>Note: the file extension does not need to be specified</sub>
    </div>
@if ($asset->type === App\Asset::TYPE_IMAGE)
    <img src="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}" alt="{{ $asset->name }}" class="img-thumbnail" height="200" width="200">
@elseif ($asset->type === App\Asset::TYPE_VIDEO)
    <video controls class="img-thumbnail" src="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}">
    </video>
@else
    <object data="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}" width="200px" height="200px"><a href="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}">{{ $asset->name }}</a></object>
@endif
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.assets.destroy', $asset->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form', '{{ $asset->name }}')">Delete {{ $asset->name }}</a>
<a class="btn btn-success pull-right" onclick="event.preventDefault();$('#edit-form').submit();">Update {{ $asset->name }}</a>
@endsection