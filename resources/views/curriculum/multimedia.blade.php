@extends('layouts.master')
@section('title', 'Curriculum')
@section('content')

<div id="features-sec" class="container set-pad" >
    <div class="row text-left">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
            <h1 class="header-line text-center">Multimedia Program</h1>
            <p><strong>The Morning Show</strong></p>
                At Courtenay Gardens, everyone is a star! We are extremely fortunate to have our very own student-run, school-based television program called "The Morning Show!"
            </p>

            <p>Our Grade 5 and 6 students broadcast the show LIVE each morning from our state-of-the-art multimedia studio, complete with a bluescreen. Students work together in small teams for four weeks at a time to improve their communication & presentation skills, as well as improve their interpersonal and character education skills, like teamwork and responsibility.</p>

            <p>In addition to our school's TV show, we also have a world-class movie-making program which is an extension to our writing program. Students from Prep to Grade 6 bring their ideas to life using script writing, storyboarding, drama and of course ICT to make very impressive movies. All our student movies are shown on "The Morning Show!" and at grade level film festival nights.</p>

            <p>Feel free to take a look at some of the award-winning resources we have created by clicking on the links below:</p>

            <p><strong>Podcasts</strong></p>
            <a href="#">Sustainability</a> (State & Overall Winner of Future Shots 2009)<br>
            <a href="#">Narrative Beginnings</a> Grade 6 <br>
            <a href="#">Persuasive Beginnings</a> Grade 3- 6 <br>
            <a href="#">Behind the Scenes</a> (41MB) <br>
            <a href="#">Rapunzel</a> Grade 6 (Adapted fairy tale) <br>
            <a href="#">Sample Maths Game</a> (41MB) Grade 4

            <p><strong>The DT Show!</strong></p>
            <p>The DT Show is an exciting new series of podcasts presented by our Grade 6 students to help others around Victoria learn about Digital Technologies. Think of these as 'Webinars for Students by Students!' On each show, we are fortunate to have a professor from RMIT as a expert guest as we discuss topics like what is data, understanding binary, networks, etc. For more info check out the following website to get involved:</p>
            <a href="http://cgpsdigitaltechnologies.global2.vic.edu.au/">http://cgpsdigitaltechnologies.global2.vic.edu.au/</a><br>

            <p><strong>Teacher and parent resources</strong></p>
            <p>More information and resources about the CGPS Multimedia Program is available at <a href="http://cgpsmultimedia.global2.vic.edu.au">http://cgpsmultimedia.global2.vic.edu.au</a></p>

            <p>If you have any further questions about the multimedia program, please feel free to send an email to <a href="mailto:balliet.scott.t@edumail.vic.gov.au">balliet.scott.t@edumail.vic.gov.au</a></p>

            <p><strong>eSmart</strong></p>
            <p>Courtenay Gardens Primary is committed to teaching our students to be responsible citizens and making great choices, especially when online.

			<p>In 2012, we volunteered to be part of a pilot program run by the Alannah and Madeline Foundation called eSmart Schools. This whole-school inniative is designed to help promote the safe, smart and responsible use of technology inside and outside of school and eliminate cyberbullying in all its forms.</p>

			<p>An eSmart Committe was formed, comprised of teachers, students and parents and we meet monthly to discuss ways to help our school become more eSmart and cybersafe. We have updated our school's Cyberbullying Policy which was approved by the school council</p>

			<p><a href="{{ url('/curriculum/esmart') }}">Click to see our eSmart page</a></p>
			
			<div class="flex">
				<img src="{{asset('assets/img/multimedia_pic1.jpg')}}">
				<img src="{{asset('assets/img/multimedia_pic2.jpg')}}">
			</div>
@endsection