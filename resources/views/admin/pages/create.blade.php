@extends('layouts.admin')
@section('title', 'Create new Page')
@section('back_link', route('admin.pages.index'))
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
            <label for="template_id">Template</label>
            <select name="template_id" id="template_id" class="form-control">
                @foreach ($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="inputs">
            
        </div>
        <a id="preview" class="btn btn-primary">Preview</a>
        <input type="submit" value="Create" class="btn btn-success">
    </form>
</div>
<script>
// create and inputs to the form
function appendSections(data) {
    $.each(data, function(index, section) {
        htmlString = "" +
            "<div class='form-group'>" +
            "<label for='content[" + section + "]'>" + section + "</label>" +
            "<textarea name='content[" + section + "]' cols='30' rows='10' class='form-control'></textarea>" +
            "</div>"
        $(htmlString).hide().appendTo("#inputs").slideDown(700);
    }); 
}

// page preview functionality
$("#preview").click(function(event) {
    event.preventDefault();
    $.get("{{ route('admin.pages.preview') }}", {id: $("#template_id").val(), name: $("#name").val(), content: $("#content").val()}, function(data) {
        var wdw = window.open();
        wdw.document.write(data);
    });
});

// get all the sections for a template
$("#template_id").change(function() {
    if ($("#inputs").html() !== "") {
        $("#inputs").html("");
    }

    $.get("{{ route('admin.templates.sections') }}", {id: $(this).val()}, appendSections, "json");
});
</script>
@endsection