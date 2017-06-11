@extends('layouts.admin')
@section('title', 'Backup and Restore')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <form action="{{ route('admin.backups.backup') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="Create Backup" class="btn btn-default">
        </form>
        <a href="{{ route('admin.backups.create') }}" class="btn btn-default">Upload Backup</a>
    </div>
</div>
@endsection
@section('table')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Restore</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($backups as $backup)
            <tr>
                <td>{{ $backup }}</td>
                <td>
                    <form action="{{ route('admin.backups.restore') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="name" value="{{ $backup }}">
                        <input type="submit" value="Restore {{ $backup }}" class="btn btn-primary">
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.backups.destroy', $backup) }}" method="post" id="{{ $backup }}-delete-form">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" value="Delete {{ $backup }}" class="btn btn-danger" onclick="confirmDelete(event, '#{{ $backup }}-delete-form', '{{ $backup }}')">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection