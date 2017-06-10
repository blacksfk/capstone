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
                <th class="sortable">Name <span class="fa fa-sort"></span></th>
                <th class="sortable">Link <span class="fa fa-sort"></span></th>
                <th>Preview</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
            <tr>
                <td>{{ $page->name }}</td>
                <td>
                    @if (isset($page->link))
                        <a href="{{ route('admin.links.edit', $page->link->id) }}">{{ $page->link->name }}</a>
                    @endif
                </td>
                <td><a href="{{ route('admin.pages.show', $page->id) }}">Preview {{ $page->name }}</a></td>
                <td><a href="{{ route('admin.pages.edit', $page->id) }}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection