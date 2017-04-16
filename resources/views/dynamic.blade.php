@extends('templates.' . $page->template->name)
@section('title', $page->name)
@section('page_content')
    {{ $page->content }}
@endsection