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
                <option value="">None</option>
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
            <label>Template sections</label>
            <hr>
            <div id="inputs">
                {{-- This should display the default templates sections --}}
                @foreach ($templates->find(1)->sections as $section)
                    <div class="form-group">
                        <label for="content[{{ $section }}]">{{ $section }}</label>
                        <textarea name="content[{{ $section }}]" id="{{ $section }}" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                @endforeach
            </div>
        </div>
        <a id="preview" class="btn btn-primary">Preview</a>
        <input type="submit" value="Create" class="btn btn-success">
    </form>
</div>
<script>
const SLIDE_TIME = 700;
// create and inputs to the form
function appendSections(data) {
    $.each(data, function(index, section) {
        htmlString = "" +
            "<div class='form-group'>" +
            "<label for='content[" + section + "]'>" + section + "</label>" +
            "<textarea name='content[" + section + "]' id=" + section + " cols='30' rows='10' class='form-control'></textarea>" +
            "</div>"
        $(htmlString).hide().appendTo("#inputs").slideDown(SLIDE_TIME);
    }); 
}

// page preview functionality
$("#preview").click(function(event) {
    event.preventDefault();
    var contentArray = {};

    $.each($("[name^='content']"), function(key, element) {
        contentArray[element.id] = element.value;
    }).promise().done(function() {
        $.get("{{ route('admin.pages.preview') }}", {id: $("#template_id").val(), name: $("#name").val(), content: JSON.stringify(contentArray)}, function(data) {
            var wdw = window.open();
            wdw.document.write(data);
        });
    })
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