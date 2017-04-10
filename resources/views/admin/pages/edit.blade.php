@extends('layouts.admin_form')
@section('title', 'Edit ' . $page->name)
@section('form')
    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="Delete {{ $page->name }}" class="btn btn-danger">
    </form>

    <form action="{{ route('admin.pages.update', $page->id) }}" method="post">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $page->name }}">
        </div>
        <div class="form-group">
            <label for="link_id">Link</label>
            <select name="link_id" id="link_id" class="form-control">
                @if (isset($page->link_id))
                    <option value="{{ $page->link_id }}" selected>{{ $page->link->name }}</option>
                @endif
                @foreach ($links as $link)
                    <option value="{{ $link->id }}">{{ $link->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $page->content }}</textarea>
        </div>
        <input type="submit" value="Update {{ $page->name }}" class="btn btn-success">
    </form>
@endsection