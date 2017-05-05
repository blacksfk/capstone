  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="{{ asset('assets/img/CGPS Web pics 019.jpg') }}" alt="web pics">
        <div class="carousel-caption">
          <h3>Resilience</h3>
          
        </div>
      </div>

      <div class="item">
        <img src="{{ asset('assets/img/CGPS Web pics 026.jpg') }}" alt="web pics">
        <div class="carousel-caption">
          <h3>Responsibility</h3>
          <p>Thank you, Chicago!</p>
        </div>
      </div>
    
      <div class="item">
        <img src="{{ asset('assets/img/CGPS rainbow.jpg') }}" alt="web pics">
        <div class="carousel-caption">
          <h3>Respect</h3>
          <p>We love the Big Apple!</p>
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>