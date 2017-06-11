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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($backups as $backup)
            <tr>
                <td>{{ $backup }}</td>
                <td><a href="{{ route('admin.backups.preview', $backup) }}">Preview/Restore/Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection