@extends('layouts.admin')
@section('title', 'Link management')
@section('content')
<a href="{{ route('admin.links.create') }}" class="btn btn-primary">Create new Link</a>
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
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="sortable">Name <span class="fa fa-sort"></span></th>
                <th>Active</th>
                <th class="sortable">Parent <span class="fa fa-sort"></span></th>
                <th class="sortable">Page <span class="fa fa-sort"></span></th>
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
                    <td>
                    @if (empty($link->page))
                        None
                    @else
                        <a href="{{ route('admin.pages.edit', $link->page->id) }}">{{ $link->page->name }}</a>
                    @endif
                    </td>
                    <td><input type="checkbox" name="{{ $link->id }}" value="1"></td>
                    <td><a href="{{ route('admin.links.edit', $link->id) }}">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('form_nav')
    <div class="row">
        <div class="pull-right">
            <a href="{{ route('admin.links.toggle') }}" onclick="appendToForm(event, '#form-massEnable', 'input:checked')" class="btn btn-success">Enable selected</a>
            <a href="{{ route('admin.links.toggle') }}" class="btn btn-default" onclick="appendToForm(event, '#form-massDisable', 'input:checked')">Disable selected</a>
        </div>
    </div>
@endsection