@extends('layouts.master')
@section('title', 'Preview ' . $name)
@section('content')
{{ $content }}
<script>
    $("a, button, input[type='submit']").not("#back").click(function(event) {
        event.preventDefault();
    });
</script>
@endsection