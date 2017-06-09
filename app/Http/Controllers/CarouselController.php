<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\CarouselItem;
use App\Messages;
use App\Http\Requests\CarouselPost;
use App\Http\Requests\ArrayPost;

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
        $assets = Asset::where("type", Asset::TYPE_IMAGE)->get();

        if (!count($assets))
        {
            return redirect()->route("admin.assets.create")
                ->with("No images exist, upload some here");
        }
        
        return view("admin.carousel.create")
            ->with("assets", $assets)
            ->with("carouselItems", CarouselItem::all());
    }

    /**
     * This removes the existing items and creates new 
     * items in the order specified
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArrayPost $request)
    {

        $success = [];

        // overwrite the current carousel
        foreach (CarouselItem::all() as $item)
        {
            $item->delete();
        }

        $success[] = Messages::CAROUSEL[Messages::CREATED];

        foreach ($request->items as $item)
        {
            $carouselItem = new CarouselItem();
            
            $carouselItem->asset_id = $item["asset_id"];
            $carouselItem->caption = $item["caption"];

            $carouselItem->save();
            $success[] = $carouselItem->asset->name . " is now part of the carousel";
        }

        return redirect()->route("admin.carousel.index")
            ->with(Messages::SUCCESS, $success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.carousel.edit")
            ->with("item", CarouselItem::findOrFail($id))
            ->with("assets", Asset::where("type", Asset::TYPE_IMAGE)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarouselPost $request, $id)
    {
        $carouselItem = CarouselItem::findOrFail($id);
        $carouselItem->asset_id = $request->asset_id;
        $carouselItem->caption = $request->caption;
        $carouselItem->save();

        return redirect()->route("admin.carousel.index")
            ->with(Messages::SUCCESS, Messages::CAROUSEL[Messages::UPDATED]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carouselItem = CarouselItem::findOrFail($id);
        $carouselItem->delete();

        return redirect()->route("admin.carousel.index")
            ->with(Messages::SUCCESS, Messages::CAROUSEL[Messages::DELETED]);
    }
}
