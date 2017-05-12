@extends('layouts.admin')
@section('title', 'Create new Page')
@section('back_link', route('admin.pages.index'))
@section('content')
<a href="{{ route('admin.pages.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.pages.store') }}" method="post" id="create-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="link_id">Link</label>
        <select name="link_id" id="link_id" class="form-control">
            <option value="">None</option>
            @foreach ($links as $link)
                <option value="{{ $link->id }}">{{ $link->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        {{-- This hidden field is required if the JS is going to be external --}}
        <input type="hidden" name="_template_route" value="{{ route('admin.templates.sections') }}">
        <label for="template_id">Template</label>
        <select name="template_id" id="template_id" class="form-control">
            @foreach ($templates as $template)
                <option value="{{ $template->id }}">{{ $template->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Template sections</label>
        <hr>
        <div id="inputs">
            {{-- This should display the default templates sections --}}
            @foreach ($templates->find(1)->sections as $section)
                <div class="form-group">
                    <label for="content[{{ $section }}]">{{ $section }}</label>
                    <div class="code-editor" data-language="php">
                        <textarea name="content[{{ $section }}]" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</form>
@endsection
@section('form_nav')
<a href="{{ route('admin.pages.preview') }}" class="btn btn-primary" onclick="previewPage(this, event)">Preview</a>
<a class="btn btn-success pull-right" onclick="event.preventDefault();$('#create-form').submit();">Create new Page</a>
@endsection