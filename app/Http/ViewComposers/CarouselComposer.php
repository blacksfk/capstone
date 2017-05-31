<?php

namespace App\Http\ViewComposers;

use App\CarouselItem;
use Illuminate\View\View;

class CarouselComposer
{
    public function compose(View $view)
    {
        $view->with("items", CarouselItem::all());
    }
}