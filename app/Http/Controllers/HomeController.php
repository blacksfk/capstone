<?php

namespace App\Http\Controllers;

use App\Page;
use App\Asset;
use App\Event;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all of the events in the database to the user ordered by date
     * 
     * @return View
     */
    public function events()
    {
        $events = Event::orderBy("date", "asc")->get();

        return view("events")->with("events", $events);
    }

    /**
     * Tries to find the page name matching the route
     * 
     * @param  string $page_name
     * @return View
     */
    public function dynamic($page_name)
    {
        $page = Page::where("name", $page_name)->first();

        if (isset($page) && View::exists($page->name))
        {
            return view($page->name);
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
