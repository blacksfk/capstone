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
                @foreach ($links as $link)
                    @if ($page->link_id === $link->id)
                        <option value="{{ $page->link->id }}" selected>{{ $page->link->name }}</option>
                    @else
                        <option value="{{ $link->id }}">{{ $link->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="template_id">Template</label>
            <select name="template_id" id="template_id" class="form-control">
                @foreach ($templates as $template)
                    @if ($page->template_id === $template->id)
                        <option value="{{ $page->template_id }}" selected>{{ $page->template->name }}</option>
                    @else
                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @endif
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