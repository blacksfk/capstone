@extends('layouts.admin')
@section('title', 'Asset management')
@section('content')
<a href="{{ route('admin.assets.create') }}" class="btn btn-primary">Upload new Asset</a>
<hr>
<div class="form-group">
    <label for="asset_filter">Filter</label>
    <select name="asset_filter" id="asset_filter" class="form-control">
        <option value="">None</option>
    @foreach ($types as $k => $v)
        <option value="{{ $k }}">{{ $v }}</option>
    @endforeach
    </select>
</div>
@endsection
@section('table')
<div class="table-responsive" id="assets_table">
    <table class="table table-hover">
        <thead>
            <th class="sortable">Name <span class="fa fa-sort"></span></th>
            <th class="sortable">Type <span class="fa fa-sort"></span></th>
            <th>Preview</th>
            <th>Edit</th>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->type }}</td>
                    <td>
                    @if ($asset->type === App\Asset::TYPE_IMAGE)
                        <img src="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}" alt="{{ $asset->name }}" class="img-thumbnail" height="200" width="200">
                    @elseif ($asset->type === App\Asset::TYPE_VIDEO)
                        <video controls class="img-thumbnail" src="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}">
                        </video>
                    @else
                        <object data="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}" width="200px" height="200px"><a href="{{ asset('assets/' . $asset->type . '/' . $asset->name) }}">{{ $asset->name }}</a></object>
                    @endif
                    </td>
                    <td><a href="{{ route('admin.assets.edit', $asset->id) }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection