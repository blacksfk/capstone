@extends('layouts.master')
@section('title', 'Contact')
@section('content')

<div id="features-sec" class="container set-pad" >
    <div class="row text-center">
        <h1 class="header-line">Contact Us</h1>

        <form id="contact-form" method="post" action="contact.php" role="form">

            <div class="form-group">
                <label for="form_name">Firstname *</label>
                <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                <div class="help-block with-errors"></div>
            </div>


            <div class="form-group">
                <label for="form_lastname">Lastname *</label>
                <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                <div class="help-block with-errors"></div>

                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                    <div class="help-block with-errors"></div>



                    <div class="form-group">
                        <label for="form_phone">Phone</label>
                        <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone">
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <label for="form_message">Message *</label>
                        <textarea id="form_message" name="message" class="form-control" placeholder="Message for CGPS" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success btn-send" value="Send message">
                    </div>
                </div>

                <p class="text-muted"><strong>*</strong> These fields are required.</p>
                <hr>
                <h2><strong>We are here: </strong></h2>

                <div class="view hm-zoom">

                    <div class="mask flex-center">
                        <div id="map"></div>
                    </div>
                </div>
                <script>
                    function initMap() {
                        var uluru = {lat: -38.079655, lng: 145.283334};
                        var map = new google.maps.Map(document.getElementById('map'), {
                          zoom: 15,
                          center: uluru
                      });
                        var marker = new google.maps.Marker({
                          position: uluru,
                          map: map
                      });
                    }
                </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1GEg7gRkcV2id4F8yoC0TtaW9Ok7jhx4&callback=initMap&libraries=places&cal"
type="text/javascript"></script>


</form>
</div>
</div>
@endsection