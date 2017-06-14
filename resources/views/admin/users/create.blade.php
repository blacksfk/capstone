@extends('layouts.admin')
@section('title', 'Create new User')
@section('content')
<a href="{{ route('admin.users.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.users.store') }}" method="post" id="create-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password_confirm">Confirm Password</label>
        <input type="password" name="password_confirm" id="password_confirm" class="form-control">
    </div>
</form>
@endsection
@section('form_nav')
<div class="text-right">
    <a href="{{ route('admin.users.store') }}" class="btn btn-success" onclick="event.preventDefault();$('#create-form').submit();">Create new User</a>
</div>
@endsection