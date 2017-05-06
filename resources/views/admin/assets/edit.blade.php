@extends('layouts.admin')
@section('title', 'Edit ' . $asset->name)
@section('content')
<form action="{{ route('admin.assets.destroy', $asset->id) }}" method="post" id ="delete-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="record" value="{{ $asset->name }}">
</form>
<form action="{{ route('admin.assets.update', $asset->id) }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PATCH">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $asset->name }}">
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" disabled>
            @foreach ($types as $key => $val)
                @if ($key === $asset->name)
                    <option value="{{ $key }}" selected>{{ $val }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <input type="submit" value="Update {{ $asset->name }}" class="btn btn-success center-block">
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.assets.index') }}" class="btn btn-warning">Cancel</a>
<a href="{{ route('admin.assets.destroy', $assets->id) }}" class="btn btn-danger" onclick="event.preventDefault();$('#delete-form').submit();">Delete {{ $asset->name }}</a>
@endsection