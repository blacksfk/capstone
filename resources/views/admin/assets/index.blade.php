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
                        <img src="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}" alt="{{ $asset->name }}" class="img-thumbnail" height="200" width="200">
                    @elseif ($asset->type === "video")
                        <video controls class="embed-responsive-item img-thumbnail">
                            <source src="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}">
                        </video>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.assets.destroy', $asset->id) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="Delete {{ $asset->name }}" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection