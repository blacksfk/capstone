@extends('layouts.master')
@section('title', '' . $page->name)
@section('content')
    {{ $page->content }}
@endsection