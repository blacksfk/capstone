@extends('layouts.admin')
@section('title', 'Create new Page')
@section('content')
<div class="form-group">
    <form action="{{ route('admin.pages.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="link_id">Link</label>
            <select name="link_id" id="link_id" class="form-control">
                @foreach ($links as $link)
                    <option value="{{ $link->id }}">{{ $link->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <input type="submit" value="Create" class="btn btn-success">
    </form>    
</div>
@endsection