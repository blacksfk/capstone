@extends('layouts.admin')
@section('title', 'Edit ' . $page->name)
@section('content')
<a href="{{ route('admin.pages.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.pages.destroy', $page->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="record" value="{{ $page->name }}">
</form>
<form action="{{ route('admin.pages.update', $page->id) }}" method="post" id="edit-form">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $page->name }}">
    </div>
    <div class="form-group">
        <label for="link_id">Link</label>
        <select name="link_id" id="link_id" class="form-control">
            <option value="">None</option>
            @if (isset($page->link))
                <option value="{{ $page->link_id }}" selected>{{ $page->link->name }}</option>
            @endif
            @foreach ($links as $link)
                <option value="{{ $link->id}}">{{ $link->name }}
            @endforeach
        </select>
    </div>
    <div class="form-group">
        {{-- This hidden field is required if the JS is going to be external --}}
        {{--<label for="template_id">Template</label>--}}

            {{--
        <select name="template_id" id="template_id" class="form-control">
            @foreach ($templates as $template)
                @if ($page->template_id === $template->id)
                    <option value="{{ $page->template_id }}" selected>{{ $page->template->name }}</option>
                @else
                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                @endif
            @endforeach
        </select>
            --}}
    </div>
    <div class="form-group">
        <hr>
        <div id="inputs">
                <div class="form-group">
                    <label for="content">Content</label>
                    <div class="code-editor" data-language="php">
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $page->content[$section] }}</textarea>
                    </div>
                </div>
        </div>
    </div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.pages.destroy', $page->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form')">Delete {{ $page->name }}</a>
<a class="btn btn-success pull-right" onclick="event.preventDefault();$('#edit-form').submit();">Update {{ $page->name }}</a>
@endsection