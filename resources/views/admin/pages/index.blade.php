@extends('layouts.admin')
@section('title', 'Edit Pages')
@section('content')
<a href="{{ route('admin.pages.create') }}" class="btn btn-info">Create new Page</a>
@endsection
@section('table')
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Link</th>
            <th>Template</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
            <tr>
                <td>{{ $page->name }}</td>
                <td>
                    @if (isset($page->link))
                        {{ $page->link->name }}
                    @endif
                </td>
                <td>{{ $page->template->name }}</td>
                <td><a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection