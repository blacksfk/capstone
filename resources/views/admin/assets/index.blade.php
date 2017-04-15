@extends('layouts.admin')
@section('title', 'Asset management')
@section('content')
<a href="{{ route('admin.assets.create') }}" class="btn btn-success">Upload new Asset</a>
<table class="table table-hover">
    <thead>
        <th>Name</th>
        <th>Type</th>
        <th>Preview</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($assets as $asset)
            <tr>
                <td>{{ $asset->name }}</td>
                <td>{{ $asset->type }}</td>
                <td>
                    @if ($asset->type === "img")
                        <img src="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}" alt="{{ $asset->name }}" class="img-thumbnail">
                    @elseif ($asset->type === "video")
                        <video controls class="embed-responsive-item">
                            <source src="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}">
                        </video>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.assets.edit', $asset->id) }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection