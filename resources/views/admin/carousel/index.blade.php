@extends('layouts.admin')
@section('title', 'Carousel')
@section('content')
<input type="hidden" class="path" value="{{asset('assets/img')}}">
<div class="container">
    <div class = "col-sm-6">
        <div class="form-group">
            <label for="name">Name</label>
                <select class="trigger form control">
                @foreach ($assets as $asset)
                    <option value={{$asset->name}}>{{$asset->name}}</option>
                @endforeach
                </select>
        </div>
        <div class="form-group">
            <label for="caption">Caption</label>
            <input type="text" name="caption" id="caption" class="form-control">
        </div>
        <button onclick="add()" type="button" class="btn btn-info">Add</button>
    </div>
    <div class = "col-sm-6">
        <img src="" class="img-thumbnail target col-sm-offset-3" width="250px" height="250px" />
    </div>
</div>

    <script>
        $( ".trigger" ).change(function() {
            var str = $(".path").val() +'/'+ $( ".trigger option:selected" ).text();
            $(".target").prop('src',str);
        });

        function add(){
            var name = $( ".trigger option:selected" ).text();
            var image = $(".path").val() +'/'+ name;
            var caption = $("#caption").val();
            $("#appendRow").append('<tr>'+
                                    '<td width="30%">'+ name +'</td>'+
                                    '<td width="30%">'+ caption + '</td>'+
                                    '<td width="30%"><img src="'+image+'" class="img-thumbnail" width="250px" height="250px"></td>'+
                                    '<td width="30%">'+
                                    '<button type="button" class="dropup"onclick="moveup(this)"><span class="caret"></span></button>'+
                                    '<button type="button" class="dropdown"onclick="movedown(this)"><span class="caret"></span></button>'+
                                    '</td>'+
                                    '</tr>'
                                    )
        }

        function moveup(object){
            var row = $(object).parents("tr:first");
            row.insertBefore(row.prev());
        }

        function movedown(object){
            var row = $(object).parents("tr:first");
            row.insertAfter(row.next());
        }
    </script>
@endsection
@section('table')
    <div class="table-responsive">
        <table class="table table-hover">
            <input type="hidden" class="path" value="{{asset('assets/img')}}">
            <thead>
            <tr>
                <th width="30%">Name</th>
                <th width="30%">Caption</th>
                <th width="30%">Preview</th>
                <th width="10%">Order</th>
            </tr>
            </thead>
            <tbody id ="appendRow">

            </tbody>
        </table>
    </div>

@endsection
