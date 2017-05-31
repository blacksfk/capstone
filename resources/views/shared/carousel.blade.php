<div id="mycarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#mycarousel" data-slide-to="0"></li>
    <li data-target="#mycarousel" data-slide-to="1"></li>
    <li data-target="#mycarousel" data-slide-to="2"></li>
    <li data-target="#mycarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item">
        <img src="{{ asset('assets/img/CGPS_26.jpg') }}" alt="CGPS logo">
        <div class="carousel-caption">
            <h2>Responsibility</h2>
        </div>
    </div>
    <div class="item">
        <img src="{{ asset('assets/img/CGPS_002.jpg') }}" alt="Second Image">
        <div class="carousel-caption">
            <h2>Resilience</h2>
        </div>
    </div>
    <div class="item">
        <img src="{{ asset('assets/img/CGPS_19.jpg') }}" alt="Third Image">
        <div class="carousel-caption">
            <h2>Honesty</h2>
        </div>
    </div>
    <div class="item">
        <img src="{{ asset('assets/img/CGPS_9.jpg') }}" alt="Fourth Image">
        <div class="carousel-caption">
            <h2>Respect</h2>
        </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

