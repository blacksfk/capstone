@extends('layouts.admin')
@section('title', 'Edit Templates')
@section('content')
<a href="{{ route('admin.templates.create') }}" class="btn btn-info">Create new Template</a>
<hr>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($templates as $template)
            <tr>
                <td>{{ $template->name }}</td>
                <td>
                    <a href="{{ route('admin.templates.edit', $template->id) }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection