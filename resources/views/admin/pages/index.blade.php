@extends('layouts.admin')
@section('title', 'Edit Pages')
@section('content')
<a href="{{ route('admin.pages.create') }}" class="btn btn-info">Create new Page</a>
<hr>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Path</th>
            <th>Link</th>
            <th>Template</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
            <tr>
                <td>{{ $page->name }}</td>
                <td>{{ $page->path }}</td>
                <td>{{ $page->link->name }}</td>
                <td>{{ $page->template->name }}</td>
                <td><a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection