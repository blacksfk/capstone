@extends('layouts.admin')
@section('title', 'Welcome')
@section('content')
	<div class="container set-pad" >
		@include('shared.sidebar')
		<div class="well col-lg-offset-3">
			<form method="post" action="addpage.php">
			<div class="controls">
			
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="form-group">Please select a page template :</label><br>
							<div class="col-lg-2 col-md-4 col-xs-6">
								<img class="img-responsive" src="assets/img/placeholder.jpeg" alt="">
								<input type="radio" name="template" id="withoutimage" value="template1" data-error="Template type required.">
							</div>
							<div class="col-lg-2 col-md-4 col-xs-6">
								<img class="img-responsive" src="assets/img/placeholder.jpeg" alt="">
								<input type="radio" name="template" id="withoutimage" value="template2" data-error="Template type required.">
							</div>
							<div class="col-lg-2 col-md-4 col-xs-6">
								<img class="img-responsive" src="assets/img/placeholder.jpeg" alt="">
								<input type="radio" name="template" id="withoutimage" value="template3" data-error="Template type required.">
							</div>
							<div class="col-lg-2 col-md-4 col-xs-6">
								<img class="img-responsive" src="assets/img/placeholder.jpeg" alt="">
								<input type="radio" name="template" id="withimage" value="template4" data-error="Template type required.">
							</div>
							<div class="col-lg-2 col-md-4 col-xs-6">
								<img class="img-responsive" src="assets/img/placeholder.jpeg" alt="">
								<input type="radio" name="template" id="withimage" value="template5" data-error="Template type required.">
							</div>
						</div>
					</div>
				</div>
			
			
				<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Page name :</label>
                            <input id="form_name" type="text" name="pagename" class="form-control" placeholder="Name of new page" required="required" data-error="Page name required.">
                        </div>
                    </div>
                </div>
				
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						<label for="form_message">Content :</label>
						<textarea id="form_message" name="content" class="form-control" placeholder="Contents of page" rows="12" required="required" data-error="No content added."></textarea>
					</div>
				</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="form_message">Upload image :</label>
							<input type="file" name="pageimage">
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
			</div>
			</form>
		</div>
	</div>
@endsection