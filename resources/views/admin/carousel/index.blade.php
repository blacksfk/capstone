@extends('layouts.admin')
@section('title', 'Carousel')
@section('content')
@endsection
@section('table')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Preview</th>
                <th>Add</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select>
                        @foreach ($assets as $asset)
                                <option value={{$asset->name}}>{{$asset->name}}</option>
                        @endforeach
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
@endsection