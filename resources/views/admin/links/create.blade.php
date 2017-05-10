@extends('layouts.admin')
@section('title', 'Create new Link')
@section('back_link', route('admin.links.index'))
@section('content')
    <form action="{{ route('admin.links.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Link name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <input type="hidden" name="active" value=0>
        <div class="form-group">
            <label for="parent">Parent</label>
            <select name="parent" id="parent" class="form-control">
                @foreach ($links as $link)
                    <option value="">None</option>
                    <option value="{{ $link->id }}">{{ $link->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" value="Create new Link" class="btn btn-success center-block">
    </form>
@endsection
@section('form_nav')
<a href="{{ route('admin.links.index') }}" class="btn btn-warning">Cancel</a>
@endsection