@extends('layouts.admin')
@section('title', 'Edit Gallery Categories')
@section('content')
<a href="{{ route('admin.gallerycategories.create') }}" class="btn btn-info">Create new Event</a>
<hr>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gallerycategories as $gallerycategory)
            <tr>
                <td>{{ $gallerycategory->name }}</td>
                <td><a href="{{ route('admin.gallerycategories.edit', $event->id) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection