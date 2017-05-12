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

                <h2><strong>We are here: </strong></h2><hr>

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
                        
                        if (document.getElementById('zone') !== null){
                            var zone = new google.maps.Map(document.getElementById('zone'), {
                              zoom: 13,
                              center: uluru
                          });
                            zoneACoordinates = [
                            {lat: -38.082223, lng: 145.276470},
                            {lat: -38.066036, lng: 145.266546},
                            {lat: -38.069698, lng: 145.298154},
                            {lat: -38.084608, lng: 145.295482}
                            ];
                            
                            zoneBCoordinates = [
                            {lat: -38.084608, lng: 145.295482},
                            {lat: -38.069698, lng: 145.298154},
                            {lat: -38.074546, lng: 145.335409},
                            {lat: -38.089474, lng: 145.332785}
                            ];
                            
                            var priorityZoneA = new google.maps.Polygon({
                              paths: zoneACoordinates,
                              strokeColor: '#ee1717',
                              strokeOpacity: 0.8,
                              strokeWeight: 2,
                              fillColor: '#ee1717',
                              fillOpacity: 0.35
                          });
                            
                            var priorityZoneB = new google.maps.Polygon({
                              paths: zoneBCoordinates,
                              strokeColor: '#2917ee',
                              strokeOpacity: 0.8,
                              strokeWeight: 2,
                              fillColor: '#2917ee',
                              fillOpacity: 0.35
                          });
                            priorityZoneA.setMap(zone);
                            priorityZoneB.setMap(zone);
/*            
            infoWindow = new google.maps.InfoWindow;
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Location found.');
                    infoWindow.open(zone);
                    zone.setCenter(pos);
                }, function() {
                        handleLocationError(true, infoWindow, zone.getCenter());
                    });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, zone.getCenter());
            }
            
            var geocoder = new google.maps.Geocoder();
            */            
            var card = document.getElementById('pac-card');
            var input = document.getElementById('pac-input');
            var types = document.getElementById('type-selector');
            var strictBounds = document.getElementById('strict-bounds-selector');

            zone.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

            var autocomplete = new google.maps.places.Autocomplete(input);

            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.
            autocomplete.bindTo('bounds', zone);

            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');
            infowindow.setContent(infowindowContent);
            var marker = new google.maps.Marker({
                map: zone,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    zone.fitBounds(place.geometry.viewport);
                } else {
                    zone.setCenter(place.geometry.location);
                    zone.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindowContent.children['place-icon'].src = place.icon;
                infowindowContent.children['place-name'].textContent = place.name;
                infowindowContent.children['place-address'].textContent = address;
                infowindow.open(zone, marker);
            });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            radioButton.addEventListener('click', function() {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
        .addEventListener('click', function() {
          console.log('Checkbox clicked! New state=' + this.checked);
          autocomplete.setOptions({strictBounds: this.checked});
      });
    }
}
/*    
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                            'Error: The Geolocation service failed.' :
                            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(zone);
    }
    */
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1GEg7gRkcV2id4F8yoC0TtaW9Ok7jhx4&callback=initMap&libraries=places&cal"
type="text/javascript"></script>


</form>
</div>
</div>
@endsection