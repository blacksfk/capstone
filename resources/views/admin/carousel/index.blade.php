@extends('layouts.admin')
@section('title', 'Carousel')
@section('content')
@endsection
@section('table')
    <div class="table-responsive">
        <table class="table table-hover">
            <input type="hidden" class="path" value="{{asset('assets/img')}}">
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
                        <select class="trigger">
                        @foreach ($assets as $asset)
                                <option value={{$asset->name}}>{{$asset->name}}</option>
                        @endforeach
                        </select>
                    </td>
                    <td>
                        <img src="" class="target" />
                    </td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
    <script>
        $( ".trigger" ).change(function() {
            var str = $(".path").val() +'/'+ $( ".trigger option:selected" ).text();
            alert (str);
            $(".target").prop('src',str);
        });
    </script>
@endsection
