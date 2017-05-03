<div class="container">
    <div class="row set-row-pad"  >
        <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 ">

            <h2><strong>Our Location: </strong></h2>
            <hr />
            <div>
                <h4>Rosebank Drive</h4>
                <h4>Cranbourne North, VIC 3977 Australia</h4>
                <h4><strong>Phone: </strong>(03) 5995 7139</h4>
                <h4><strong>Fax: </strong>(03) 5995 7148</h4>
                <h4><strong>Email: </strong>courtenay.gardens.ps@edumail.vic.gov.au</h4>
            </div>


        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">

            <h2><strong>We are here: </strong></h2><hr>

            <div class="view hm-zoom">
                
                <div class="mask flex-center">
                <div id="map"></div>
                </div>
            </div>


        </div>
    </div>
</div>
<div id="footer">
    <div id="google_translate_element"></div>
    &copy; 2017 Courtenay Gardens Primary School | All Rights Reserved

    <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script>
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
        
        var zone = new google.maps.Map(document.getElementById('zone'), {
          zoom: 15,
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
          strokeColor: '#FF000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF000',
          fillOpacity: 0.35
        });
        
        var priorityZoneB = new google.maps.Polygon({
          paths: zoneBCoordinates,
          strokeColor: '#FF000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF000',
          fillOpacity: 0.35
        });
        priorityZoneA.setMap(zone);
        priorityZoneB.setMap(zone);
      }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</div>