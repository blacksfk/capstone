@extends('layouts.admin')
@section('title', 'User management')
@section('content')
<a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create new User</a>
@endsection
@section('table')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="sortable">Name <span class="fa fa-sort"></span></th>
                <th class="sortable">email <span class="fa fa-sort"></span></th>
                <th class="sortable">Admin <span class="fa fa-sort"></span></th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    {{ $user->name }}
                    @if (Auth::user()->id === $user->id)
                        <span class="fa fa-star-o"><span>&nbsp;Current User&nbsp;</span></span><span class="fa fa-star-o"></span>
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ ($user->is_admin ? "True" : "False") }}</td>
                <td><a href="{{ route('admin.users.edit', $user->id) }}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection