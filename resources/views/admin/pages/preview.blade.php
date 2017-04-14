@extends('templates.' . $template->name)
@section('title', 'Preview ' . $name)
@section('page_content')
{{ $content }}
<script>
    $("a, button, input[type='submit']").click(function(event) {
        event.preventDefault();
    });
</script>
@endsection