@extends('layouts.admin')
@section('title', 'Welcome')
@section('content')
	<div class="container set-pad" >
		@include('shared.sidebar')
		<div class="well col-lg-offset-3">
			<form method="post" action="addpage.php">
				<div class="controls">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="form_name">Page name :</label>
								<input id="form_name" type="text" name="name" class="form-control" placeholder="Name of new page" required="required" data-error="Page name required.">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1 col-md-offset-1">
							<input type="submit" class="btn btn-success btn-send" value="Save">
						</div>
						<div class="col-md-1 col-md-offset-1">
							<input type="submit" class="btn btn-success btn-send" value="Preview">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection