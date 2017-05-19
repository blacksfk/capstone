@extends('layouts.admin')
@section('title', 'TEST')
@section('content')
    <a href="{{ route('admin.newsletter.create') }}" class="btn btn-primary">Upload new Newsletters</a>
@endsection
@section('table')
    <?php
    unset($newsletters[0]);
    unset($newsletters[1]);
    ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($newsletters as $newsletter)
                <tr>
                    <td>{{$newsletter}}</td>
                    <td>
                        <form action="{{ route('admin.newsletter.destroy', $newsletter) }}" method="post" id="delete-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Delete {{ $newsletter }}" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection