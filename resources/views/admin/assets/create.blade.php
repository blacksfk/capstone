@extends('layouts.admin')
@section('title', 'Upload new asset')
@section('content')
<form action="{{ route('admin.assets.store') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control">
            @foreach ($types as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="asset">Upload</label>
        <input type="file" name="asset" id="asset">
    </div>
    <input type="submit" value="Upload new Asset" class="btn btn-success">
</form>
@endsection