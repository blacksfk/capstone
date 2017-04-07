@extends('layouts.admin')
@section('title', 'Welcome')
@section('content')
<style type="text/css">
input[type=checkbox] {
    display:none;
}

input[type=checkbox] + label {
    background: #999;
    height: 16px;
    width: 16px;
    display:inline-block;
    padding: 0 0 0 0px;
}

input[type=checkbox]:checked + label {
    background: #0080FF;
    height: 16px;
    width: 16px;
    display:inline-block;
    padding: 0 0 0 0px;
}
</style>
		<form>
			<label class="form-group">Images : </label><br>
			<?php
			@foreach ($categories as $category)
				@foreach ($images as $image)
					echo "<input type='checkbox' name='";
					echo {{$image->$name}};
					echo "'value=";
					echo {{$image->$name}};
					echo "id='thing'/><label for='thing'></label>";
				@endforeach
			@endforeach
			?>
			<input type="submit" class="btn btn-success btn-send" value="Delete">
		</form>
@endsection