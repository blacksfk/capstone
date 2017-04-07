@extends('layouts.admin')
@section('title', 'Link management')
@section('content')
<a href="{{ route('admin.links.create') }}" class="btn btn-info">Create new Link</a>
<hr>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Parent</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($links as $link)
            <tr>
                <td>{{ $link->name }}</td>
                <td>
                    @if ($link->active)
                        {{ "True" }}
                    @endif
                </td>
                <td>
                    @if (!empty($link->parent_id))
                        {{ $link->parent->name }}
                    @endif
                </td>
                <td><a href="{{ route('admin.links.edit', $link->id) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection