@extends('layouts.master')
@section('title', 'Preview ' . $name)
@section('content')
    {{ $content }}
<script>
    $("a, button, input[type='submit']").click(function(event) {
        event.preventDefault();
    });
</script>
@endsection