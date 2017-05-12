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
@endsection