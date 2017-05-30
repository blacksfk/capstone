<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\CarouselItem;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.carousel.index")
            ->with("carouselItems", CarouselItem::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assets = Asset::where("type", "img")->get();

        if (!count($assets))
        {
            return redirect()->route("admin.assets.create")
                ->with("No images exist, upload some here");
        }
        
        return view("admin.carousel.create")
            ->with("assets", Asset::where("type", "img")->get())
            ->with("carouselItems", CarouselItem::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // overwrite the current carousel
        CarouselItem::all()->delete();
        $success = [];

        foreach ($request->items as $item)
        {
            $carouselItem = new CarouselItem();
            
            $carouselItem->asset_id = $item->asset_id;
            $carouselItem->caption = $item->caption;

            $carouselItem->save();
            $success[] = $carouselItem->asset->name . " is now part of the carousel";
        }

        return redirect()->route("admin.carousel.index")->with("success", $success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CarouselItem::destroy($id);

        return view("admin.carousel.index")
            ->with("success", "Carousel item removed");
    }
}
