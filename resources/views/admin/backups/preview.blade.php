@extends('layouts.admin')
@section('title', 'Preview ' . $backup)
@section('content')
<a href="{{ route('admin.backups.index') }}" class="btn btn-warning">Cancel</a>
<form action="{{ route('admin.backups.restore', $backup) }}" method="post" id="restore-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
</td>
<td>
<form action="{{ route('admin.backups.destroy', $backup) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
@endsection
@section('table')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="sortable">Name <span class="fa fa-sort"></span></th>
                <th class="sortable">Size <span class="fa fa-sort"></span></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($files as $file)
            <tr>
                <td>{{ $file["name"] }}</td>
                <td>{{ round($file["size"] / 1024, 1) }} kB</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('form_nav')
<a href="{{ route('admin.backups.destroy', $backup) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form', '{{ $backup }}')">Delete {{ $backup }}</a>
<a href="{{ route('admin.backups.restore', $backup) }}" class="btn btn-primary pull-right" onclick="event.preventDefault();$('#restore-form').submit();">Restore {{ $backup }}</a>
@endsection