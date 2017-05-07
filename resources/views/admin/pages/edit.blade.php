@extends('layouts.admin')
@section('title', 'Edit ' . $page->name)
@section('back_link', route('admin.pages.index'))
@section('content')
<form action="{{ route('admin.pages.destroy', $page->id) }}" method="post" id="delete-form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="record" value="{{ $page->name }}">
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
        <input type="hidden" name="_template_route" value="{{ route('admin.templates.sections') }}">
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
        <label>Template sections</label>
        <hr>
        <div id="inputs">
            @foreach ($page->template->sections as $section)
                <div class="form-group">
                    <label for="content[{{ $section }}]">{{ $section }}</label>
                    <textarea name="content[{{ $section }}]" id="content[{{ $section }}]" cols="30" rows="10" class="form-control">{{ $page->content[$section] }}</textarea>
                </div>
            @endforeach
        </div>
    </div>
    <input type="submit" value="Update {{ $page->name }}" class="btn btn-success center-block">
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.pages.index') }}" class="btn btn-warning">Cancel</a>
<a href="{{ route('admin.pages.destroy', $page->id) }}" class="btn btn-danger" onclick="confirmDelete(event, '#delete-form')">Delete {{ $page->name }}</a>
@endsection