@extends('layouts.admin')
@section('title', 'Link management')
@section('content')
<a href="{{ route('admin.links.create') }}" class="btn btn-info">Create new Link</a>
<hr>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Parent</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($links as $link)
            <tr>
                <td>{{ $link->name }}</td>
                <td>{{ $link->status }}</td>
                <td>{{ $link->parent }}</td>
                <td><a href="{{ route('admin.events.edit', $link->id) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection