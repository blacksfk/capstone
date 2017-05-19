@extends('layouts.admin')
@section('title', 'Upload Newsletter')
@section('content')
    <a href="{{ route('admin.newsletter.index') }}" class="btn btn-warning">Cancel</a>
    <hr>
    <form action="{{ route('admin.newsletter.store') }}" enctype="multipart/form-data" method="post" id="create-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="asset">Upload</label>
            <input type="file" name="asset" id="asset">
        </div>
        <div class="form-group">
            <label for="Issue">Issue Number</label>
            <input type="number" name="issue" id="issue" class="form-control" min="1" max="20"></div>
        </div>
    </form>
@endsection
@section('form_nav')
    <div class="text-right">
        <a class="btn btn-success" onclick="event.preventDefault();$('#create-form').submit();">Upload Newsletter</a>
    </div>
@endsection