<?php

namespace App\Http\Controllers;

use App\Link;
use App\Asset;
use App\Event;
use App\Utility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
    /**
     * Show all of the events in the database to the user ordered by date
     * 
     * @return View
     */
    public function events()
    {
        $carbon = Carbon::now("Australia/Melbourne");
        $w = Event::where("date", ">=", $carbon->startOfWeek()->format("Y-m-d"))
                    ->where("date", "<=", $carbon->endOfWeek()->format("Y-m-d"))
                    ->orderBy("date", "asc")
                        ->get();
        $m = Event::where("date", ">=", $carbon->startOfMonth()->format("Y-m-d"))
                    ->where("date", "<=", $carbon->endOfMonth()->format("Y-m-d"))
                    ->orderBy("date", "asc")
                    ->get();
        $y = Event::where("date", ">=", $carbon->startOfYear()->format("Y-m-d"))
                    ->where("date", "<=", $carbon->endOfYear()->format("Y-m-d"))
                    ->orderBy("date", "asc")
                    ->get();

        return view("events")
                ->with("week", $w)
                ->with("month", $m)
                ->with("year", $y);
    }

    /**
     * Tries to find the page name matching the route
     * 
     * @param  string $page_name
     * @return View
     */
    public function dynamic($name)
    {
        $link = Link::where("name", "LIKE", $name)->first();

        if (isset($link) && View::exists($link->page->name))
        {
            return view($link->page->name);
        }

        abort(404);
    }

    /**
     * Shows all of the newsletters in the database to the user ordered by name
     * 
     * @return View
     */
    public function newsletters()
    {
        $nl = Asset::where("type", Asset::TYPE_NEWSLETTER)->orderBy("name")->get();

        return view("newsletters")->with("newsletters", $nl);
    }

    /**
     * Retrieves the canteen menu from the database
     * 
     * @return View
     */
    public function canteenMenu()
    {
        //
    }

}
