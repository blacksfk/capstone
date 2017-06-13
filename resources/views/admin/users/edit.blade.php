@extends('layouts.admin')
@section('title', 'Edit ' . $user->name)
@section('content')
<a href="{{ route('admin.users.index') }}" class="btn btn-warning">Cancel</a>
<form action="{{ route('admin.users.destroy', $user->id) }}" method="post"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"></form>
<hr>
<h3>Change details</h3>
<form action="{{ route('admin.users.update', $user->id) }}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
    </div>
    <input type="submit" value="Update {{ $user->name }}'s details" class="btn btn-default">
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
    <input type="submit" value="Update {{ $user->name }}'s password" class="btn btn-default">
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger" onclick="event.preventDefault();$('#delete-form').submit();">Delete {{ $user->name }}</a>
@endsection