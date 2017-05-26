@extends('layouts.admin')
@section('title', 'Carousel')
@section('content')
    <input type="hidden" class="path" value="{{asset('assets/img')}}">
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="name">Name</label>
                <select class="trigger form-control">
                    @foreach ($assets as $asset)
                        <option value={{$asset->name}}>{{$asset->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Issue">Caption</label>
                <input type="text" name="caption" id="caption" class="form-control">
            </div>
            <div class="form-group">
                <button id="add" type="button" class="btn btn-info center-block ">Add</button>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group col-xs-offset-4">
                <img style="width:250px;height:250px;" src="" class="target img-thumbnail" />
            </div>
        </div>
    </div>

    <script>
        $( ".trigger" ).change(function() {
            var str = $(".path").val() +'/'+ $( ".trigger option:selected" ).text();
            // alert (str);
            $(".target").prop('src',str);
        });

        $( "#add" ).click(function() {
            var name = $(".trigger option:selected").text();
            var caption = $("#caption").val();
            var str = $(".path").val() +'/'+ name;
            var image = '<img style="width:150px;height:150px;" src="'+str+'" class="img-thumbnail" />'
            $( "#appendRows" ).append( '<tr>' +
                                        '<td width=30%>'+name+'</td>' +
                                        '<td width=30%>'+caption+'</td>' +
                                        '<td width=30%>'+image+'</td>' +
                                        '<td width=10%>'+
                                            '<button class="dropup" onclick="moveup(this)">'+
                                            '<span class="caret"></span></button>'+
                                            '<button class="dropdown" onclick="movedown(this)">'+
                                            '<span class="caret"></span></button>'+
                                        '</td>'+
                                       '</tr>');
        });

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
            <thead>
            <tr>
                <th width=30%>Name</th>
                <th width=30%>Caption</th>
                <th width=30%>Preview</th>
                <th width=10%>Order</th>
            </tr>
            </thead>
            <tbody id="appendRows">

            </tbody>
        </table>
        <hr>
        <div class="form-group">
            <button id="Submit" type="button" class="btn btn-info center-block ">Submit</button>
        </div>
    </div>
@endsection


