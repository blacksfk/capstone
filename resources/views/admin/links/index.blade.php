@extends('layouts.admin')
@section('title', 'Link management')
@section('content')
<a href="{{ route('admin.links.create') }}" class="btn btn-info">Create new Link</a>
<hr>
<form action="{{ url('admin/links/massEnable') }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Parent</th>
            <th>Enable</th>
            <th>Edit</th>
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
                <td><input type="checkbox" name="{{ $link->id }}" value="1"></td>
                <td><a href="{{ route('admin.links.edit', $link->id) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<input type="submit" value="Enable ticked" class="btn btn-primary"></form>
@endsection