@extends('layouts.admin')
@section('title', 'Edit Pages')
@section('content')
<a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Create new Page</a>
@endsection
@section('table')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="sortable">Name</th>
                <th>Link</th>
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
                <td><a href="{{ route('admin.pages.edit', $page->id) }}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection