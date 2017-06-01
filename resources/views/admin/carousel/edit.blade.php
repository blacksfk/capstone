@extends('layouts.admin')
@section('title', 'Edit ' . $item->asset->name)
@section('content')
<a href="{{ route('admin.carousel.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.carousel.destroy', $item->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="record" value="{{ $item->asset->name }}">
</form>
<form action="{{ route('admin.carousel.update', $item->id) }}" method="post" id="edit-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_asset_path" id="_asset_path" value="{{ asset('assets/img/') }}" disabled>
    <div class="form-group">
        <label for="carousel-select">Image</label>
        <select name="asset_id" id="carousel-select" class="form-control">
            <option value="{{ $item->asset_id }}" selected>{{ $item->asset->name }}</option>
        @foreach ($assets as $asset)
            <option value="{{ $asset->id }}">{{ $asset->name }}</option>
        @endforeach
        </select>

        <img src="{{ asset('assets/img/' . $item->asset->name) }}" alt="{{ $item->asset->name }}" id="carousel-preview" class="img-thumbnail" height="200px" width="200px">
    </div>
    <div class="form-group">
        <label for="caption">Caption</label>
        <input type="text" name="caption" id="caption" value="{{ $item->caption }}" class="form-control">
    </div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.carousel.destroy', $item->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form')">Delete {{ $item->asset->name }}</a><a href="{{ route('admin.carousel.update', $item->id) }}" class="btn btn-success pull-right" onclick="event.preventDefault();$('#edit-form').submit();">Update {{ $item->asset->name }}</a>
@endsection