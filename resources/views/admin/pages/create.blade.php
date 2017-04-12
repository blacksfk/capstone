@extends('layouts.admin_form')
@section('title', 'Create new Page')
@section('form')
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
            <label for="template_id">Template</label>
            <select name="template_id" id="template_id" class="form-control">
                @foreach ($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <a id="preview" class="btn btn-primary">Preview</a>
        <input type="submit" value="Create" class="btn btn-success">
    </form>
</div>
<script>
    $("#preview").click(function(event) {
        event.preventDefault();
        $.get("{{ route('admin.pages.preview') }}", {id: $("#template_id").val(), name: $("#name").val(), content: $("#content").val()}, function(data) {
            var wdw = window.open();
            wdw.document.write(data);
        });
    });
</script>
@endsection