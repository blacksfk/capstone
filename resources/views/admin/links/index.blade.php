@extends('layouts.admin')
@section('title', 'Link management')
@section('content')
<a href="{{ route('admin.links.create') }}" class="btn btn-info">Create new Link</a>
<form action="{{ url('admin/links/massEnable') }}" method="post" id="form-massEnable">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
@endsection
@section('table')
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Parent</th>
            <th>Page</th>
            <th>Enable</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($links as $link)
            <tr>
                <td>{{ $link->name }}</td>
                <td>
                    <?php echo($link->active ? "True" : "False"); ?>
                </td>
                <td>
                    @if (!empty($link->parent_id))
                        {{ $link->parent->name }}
                    @endif
                </td>
                <td>
                    @if (!empty($link->page))
                        {{ $link->page->name }}
                    @endif
                </td>
                <td><input type="checkbox" name="{{ $link->id }}" value="1"></td>
                <td><a href="{{ route('admin.links.edit', $link->id) }}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('form_nav')
<a href="{{ url('admin/links/massEnable') }}" onclick="event.preventDefault();$('#form-massEnable').submit();" class="btn btn-primary">Enable ticked</a>
@endsection