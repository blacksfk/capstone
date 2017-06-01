@extends('layouts.admin')
@section('title', 'Carousel')
@section('content')
<a href="{{ route('admin.carousel.create') }}" class="btn btn-primary">Edit Carousel</a>
@endsection
@section('table')
<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th>Name</th>
            <th>Caption</th>
            <th>Preview</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carouselItems as $item)
        <tr>
            <td>{{ $item->asset->name }}</td>
            <td>{{ $item->caption }}</td>
            <td><img src="{{ asset('assets/' . $item->asset->type . '/' . $item->asset->name) }}" alt="" class="img-thumbnail" height="200px" width="200px"></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

