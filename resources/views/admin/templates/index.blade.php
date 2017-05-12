@extends('layouts.admin')
@section('title', 'Edit Templates')
@section('content')
<a href="{{ route('admin.templates.create') }}" class="btn btn-primary">Create new Template</a>
@endsection
@section('table')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Sections</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($templates as $template)
                <tr>
                    <td>{{ $template->name }}</td>
                    <td>{{ implode(", ", $template->sections) }}</td>
                    <td>
                        <a href="{{ route('admin.templates.edit', $template->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection