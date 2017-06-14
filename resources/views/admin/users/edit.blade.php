@extends('layouts.admin')
@section('title', 'Edit ' . $user->name)
@section('content')
<a href="{{ route('admin.users.index') }}" class="btn btn-warning">Cancel</a>
<form action="{{ route('admin.users.destroy', $user->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<hr>
<h3>Change details</h3>
<form action="{{ route('admin.users.update', $user->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
    </div>
    <div class="text-right"><input type="submit" value="Update {{ $user->name }}'s details" class="btn btn-default"></div>
</form>
<hr>
<h3>Change password</h3>
<form action="{{ route('admin.users.updatePassword', $user->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password_confirm">Confirm Password</label>
        <input type="password" name="password_confirm" id="password_confirm" class="form-control">
    </div>
    <div class="text-right"><input type="submit" value="Update {{ $user->name }}'s password" class="btn btn-default"></div>
</form>
<hr>
<h3>Elevate Privileges</h3>
<form action="{{ route('admin.users.elevatePrivileges', $user->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <label for="is_admin">Admin</label>
    <div class="form-group">
        <ul class="list-unstyled">
            <li><input type="radio" name="is_admin" id="is_admin" value="1" {{ ($user->is_admin ? "checked" : "" ) }}> Admin</li>
            <li><input type="radio" name="is_admin" id="is_admin" value="0" {{ ($user->is_admin ? "" : "checked" ) }}> Not admin</li>
        </ul>
    </div>
    <div class="text-right"><input type="submit" value="Update {{ $user->name }}'s privileges" class="btn btn-default"></div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form', '{{ $user->name }}')">Delete {{ $user->name }}</a>
@endsection