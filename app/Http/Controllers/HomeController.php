<?php

namespace App\Http\Controllers;

use App\Link;
use App\Asset;
use App\Event;
use App\Utility;
use App\Messages;
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
        $events = Event::orderBy("date", "asc")->get();

        return view("events")->with("events", $events);
    }

    /**
     * Tries to find the page name matching the route
     * 
     * @param  string $page_name
     * @return View
     */
    public function dynamic($name)
    {
        $link = Link::where("name", $name)->first();

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


    public function sendEmail(Request $request)
    {

        // The message
        $message = "Line 1\r\nLine 2\r\nLine 3";

        // In case any of our lines are larger than 70 characters, we should use wordwrap()
        $message = wordwrap($message, 70, "\r\n");

        // Send

        $headers = 'From: test@sharklasers.com' . "\r\n";

        mail('testpoop@sharklasers.com', 'My Subject', $message,$headers);

        return redirect()->route("index")
            ->with(Messages::SUCCESS, Messages::CONTACT[Messages::SUCCESS]);
    }
}
