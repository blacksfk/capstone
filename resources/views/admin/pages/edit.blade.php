@extends('layouts.admin')
@section('title', 'Edit ' . $page->id)
@section('content')
<div class="form-group">
    {{ Form::model($page, ['method' => 'DELETE', 'route' => ['admin.pages.destroy', $page]]) }}
        {{ Form::submit('Delete ' . $page->id, ['class' => 'form-control btn btn-danger']) }}
    {{ Form::close() }}

    {{ Form::model($page, ['method' => 'PATCH', 'route' => ['admin.pages.update', $page]]) }}
        @include('admin.pages.form')
    {{ Form::close() }}
</div>
@endsection