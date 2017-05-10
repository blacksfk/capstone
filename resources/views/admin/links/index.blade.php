@extends('layouts.admin')
@section('title', 'Link management')
@section('content')
<a href="{{ route('admin.links.create') }}" class="btn btn-info">Create new Link</a>
<form action="{{ route('admin.links.toggle') }}" method="post" id="form-massEnable" class="hiddenForm">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_enable" value="1">
</form>
<form action="{{ route('admin.links.toggle') }}" method="post" id="form-massDisable" class="hiddenForm">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_enable" value="0">
</form>
@endsection
@section('table')
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Parent</th>
            <th>Page</th>
            <th>Select</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($links as $link)
            <tr>
                <td>{{ $link->name }}</td>
                <td>{{ ($link->active ? "True" : "False") }}</td>
                <td>{{ (empty($link->parent_id) ? "None" : $link->parent->name) }}</td>
                <td>{{ (empty($link->page) ? "None" : $link->page->name) }}</td>
                <td><input type="checkbox" name="{{ $link->id }}" value="1"></td>
                <td><a href="{{ route('admin.links.edit', $link->id) }}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('form_nav')
<a href="{{ route('admin.links.toggle') }}" onclick="appendToForm(event, '#form-massEnable', 'input:checked')" class="btn btn-primary">Enable ticked</a>
<a href="{{ route('admin.links.toggle') }}" class="btn btn-warning" onclick="appendToForm(event, '#form-massDisable', 'input:checked')">Disable ticked</a>
@endsection