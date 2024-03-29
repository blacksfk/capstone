<div id="mycarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    @for ($i = 0; $i < count($items); $i++)
        <li data-target="#mycarousel" data-slide-to="{{ $i }}"></li>
    @endfor
    </ol>
  
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
@foreach ($items as $item)
    <div class="item">
        <img src="{{ asset('assets/' . $item->asset->type . '/' . $item->asset->name) }}" alt="{{ $item->asset->name }}">
        <div class="carousel-caption">
            <h2>{{ $item->caption }}</h2>
        </div>
    </div>
@endforeach
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
        <span class="fa fa-chevron-left fa-2x" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
        <span class="fa fa-chevron-right fa-2x" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

