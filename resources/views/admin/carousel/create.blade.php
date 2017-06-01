@extends('layouts.admin')
@section('title', 'Update Carousel')
@section('content')
<a href="{{ route('admin.carousel.index') }}" class="btn btn-warning">Cancel</a>
<hr>
<form action="{{ route('admin.carousel.store') }}" method="post" id="create-form" class="hiddenForm">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_asset_path" id="_asset_path" value="{{ asset('assets/img/') }}" disabled>
</form>
<div class="form-group">
    <label for="carousel-select">Image</label>
    <select name="carousel-select" id="carousel-select" class="form-control">
    @foreach ($assets as $asset)
        <option value="{{ $asset->id }}">{{ $asset->name }}</option>
    @endforeach
    </select>
</div>
<div class="form-group">
    <img src="{{ asset('assets/' . $assets[0]->type . '/' . $assets[0]->name) }}" alt="{{ $assets[0]->name }}" id="carousel-preview" class="img-thumbnail" height="200px" width="200px">
</div>
<div class="form-group">
    <label for="carousel-caption">Caption</label>
    <input type="text" name="carousel-caption" id="carousel-caption" class="form-control">
</div>
<div class="text-right"><button class="btn btn-default" onclick="appendToCarousel(event, '#carousel-table > tbody')"><span class="fa fa-plus"></span></button></div>
@endsection
@section('table')
<table id="carousel-table" class="table table-hover table-responsive">
    <thead>
        <tr>
            <th>No.</th>
            <th>Asset ID</th>
            <th>Caption</th>
            <th>Image</th>
            <th>Order</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carouselItems as $index => $item)
        <tr>
            <td>&#35;{{ $index + 1 }}</td>
            <td><input type="text" name="items[{{ $index }}][asset_id]" class="form-control" value="{{ $item->asset_id }}" readonly></td>
            <td><input type="text" name="items[{{ $index }}][caption]" class="form-control" value="{{ $item->caption }}"></td>
            <td><img src="{{ asset('assets/' . $item->asset->type . '/' . $item->asset->name) }}" alt="{{ $item->asset->name }}" class="img-thumbnail" height="200px" width="200px"></td>
            <td>
                <button class="btn btn-default" onclick="shiftUp(this, event)"><span class="fa fa-arrow-circle-up"></span></button>
                <button class="btn btn-default" onclick="shiftDown(this, event)"><span class="fa fa-arrow-circle-down"></span></button>
            </td>
            <td><button class="btn btn-default" onclick="deleteRow(this, event)"><span class="fa fa-times"></span></button></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('form_nav')
    <div class="text-right">
        <a class="btn btn-success" onclick="confirmOverwrite(event, '#create-form', appendToForm, 'td > input')">Update Carousel</a>
    </div>
@endsection