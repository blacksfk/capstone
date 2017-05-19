@extends('layouts.master')
@section('title', 'Enrolment')
@section('content')

<div class="container set-pad">
<div class="row">
<div class="text-center">
    <p>Click <a href="{{ asset('assets/pdf/enrol.pdf') }}" target="_blank">here</a> to download the official policy on CGPS enrolment areas.</p>
</div>
    
    <h1 class="header-line text-center">Where do you need to live to attend CGPS?</h1>
    
    <p>
    Due to the rapid population growth within the City of Casey, Courtenay Gardens Primary 
    School has a strict enrolment policy with a DET approved enrolment zone around it from which students may attend.
    </p>
    
    <p>
    If you live within the zone – Your child/children will be guaranteed a placement at Courtenay Gardens school.
    An interview will need to be scheduled by contacting the office and enrolment forms filled out.
    </P>
    
    <p>
    If you live outside the zone – We will do our best to arrange for a placement if a vacancy exists within your child/children’s 
    grade level. An interview will need to be scheduled by contacting the office and enrolment forms filled out. 
    Parents will then be notified if there is a vacancy available at their child’s grade level. 
    </p>
    
    <div class="container">
        <div class="col-lg-8 col-md-8 col-xs-8">
            <a class="thumbnail" href="#">
                <img class="img-responsive" src="{{ asset('assets/img/priority_zones.JPG') }}" alt="">
            </a>
        </div>
    </div>
    
    <div class="pac-card" id="pac-card">
        <div>
            <div id="title">
                Address Lookup
            </div>
            <div id="type-selector" class="pac-controls">
                <input type="radio" name="type" id="changetype-all" checked="checked">
                <label for="changetype-all">All</label>

                <input type="radio" name="type" id="changetype-establishment">
                <label for="changetype-establishment">Establishments</label>

                <input type="radio" name="type" id="changetype-address">
                <label for="changetype-address">Addresses</label>

                <input type="radio" name="type" id="changetype-geocode">
                <label for="changetype-geocode">Geocodes</label>
            </div>
            <div id="strict-bounds-selector" class="pac-controls">
                <input type="checkbox" id="use-strict-bounds" value="">
                <label for="use-strict-bounds">Strict Bounds</label>
            </div>
        </div>
        <div id="pac-container">
            <input id="pac-input" type="text" placeholder="Enter a location">
        </div>
    </div>
    <div id="zone"></div>
    <div id="infowindow-content" >
        <img src="" width="16" height="16" id="place-icon">
        <span id="place-name"  class="title"></span><br>
        <span id="place-address"></span>
    </div>
    
    <h1 class="header-line text-center">Enrolment Info</h1>
    
    <p>
    Enrolments are taken from mid-March onwards each year. Since large numbers of newchildren begin each year, 
    it is preferable to have enrolments in as soon as possible to ensure we have enough rooms and the best qualilty teachers for your child. 
    If you have a child who will be starting school in the following year, contact the school on (03) 5995 7139 for further information.
    </p>
    
    <p>
    School tours are organised on a group basis throughout July and October. Bookings are essential. Please contact the school office for further details.
    </p>
    
    <p>
    A Prep Information evening will also take place in October. It is important to note that Courtenay Gardens PS has a Designated Neighbourhood enrolment policy. 
    Enrolment is only guaranteed to children within the Designated Neighbourhood. Other children will be accomodated if space and facilities permit.
    </p>
    
    <h1 class="header-line text-center">What are the requirements to enrol my child?</h1>
    
    <ul>
    <li>Original birth certificate</li>
    <li>Original immunisation Certificate</li>
    <li>Passport (if born overseas)</li>
    <li>Proof of residence (2 of any of the following must be presented before an interview can be arranged:
    rates notice, bills, bank statements, rental agreement, building contracts or contract of sale.)</li>
    </ul>
    
    <h1 class="header-line text-center">What is the 'School Entry Immunisation Certificate' and why is it required?</h1>
    
    <p>
    This is a certificate, issued either by the Australian Childhood Immunisation Register or your local council health department, which shows that:
    </p>
    
    <ul>
    <li>your child has been immunised against measles, mumps, diptheria, tetanus and polio, or</li>
    <li>there is good reason why your child has not been immunised.</li>
    </ul>
    
    <p>
    <strong>Please note:</strong> if the Australian Childhood Immunisation Register certificate does NOT contain the statement "This child has received all vaccine required by 5 years of age",
    please contact your local council immunisation service to receive further information with regard to immunisations or to 
    obtain a council issued school entry immunisation certificate.
    </p>
    
    <p>
    A very special thankyou to all our fantastic Grade Prep staff on the magnificent job they do welcoming new students to our school.
    </p>
</div>
</div>

<script>
    function initMap() {
        var uluru = {lat: -38.079655, lng: 145.283334};
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
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1GEg7gRkcV2id4F8yoC0TtaW9Ok7jhx4&callback=initMap&libraries=places&cal"
type="text/javascript"></script>
@endsection