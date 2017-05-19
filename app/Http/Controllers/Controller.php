<?php

namespace App\Http\Controllers;

use App\Event;
use App\Page;
use App\Asset;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
    public function dynamic($page_name = "home")
    {
        $page = Page::where("name", $page_name)->first();

        if (!isset($page))
        {
            return redirect("/");
        }

        return view("dynamic")->with("page", $page);
    }

}
