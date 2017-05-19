@extends('layouts.admin')
@section('title', 'Upload Newsletter')
@section('content')
    <a href="{{ route('admin.newsletter.index') }}" class="btn btn-warning">Cancel</a>
    <hr>
    <form action="{{ route('admin.carousel.store') }}" enctype="multipart/form-data" method="post" id="create-form">
        <div class="form-group">
            <label for="carousel">Select image for carousel:</label>
            <input id="imageselector" type="dropdown" name="carousel" id="carousel" value="default.jpg">
        </div>
        <div class="form-group">
            <img id="imagepreview" src="">
        </div>
    </form>
    <script>
        $("#imageselector").click(function(event){
            var name = $(this).val();
            var url = "{{ asset('assets/img/'."+ name +") }}";
            $("#imagepreview").prop("src", url);
        });
    </script>
@endsection
@section('form_nav')
    <div class="text-right">
        <a class="btn btn-success" onclick="event.preventDefault();$('#create-form').submit();">Upload Newsletter</a>
    </div>
@endsection