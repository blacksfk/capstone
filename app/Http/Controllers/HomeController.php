<?php

namespace App\Http\Controllers;

use App\Link;
use App\Asset;
use App\Event;
use App\Utility;
use App\Mail\CommentReceived;
use App\Messages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;


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
        $w = Event::where("start_date", ">=", $carbon->startOfWeek()->format("Y-m-d"))
                    ->where("end_date", "<=", $carbon->endOfWeek()->format("Y-m-d"))
                    ->orderBy("start_date", "asc")
                        ->get();
        $m = Event::where("start_date", ">=", $carbon->startOfMonth()->format("Y-m-d"))
                    ->where("end_date", "<=", $carbon->endOfMonth()->format("Y-m-d"))
                    ->orderBy("start_date", "asc")
                    ->get();
        $y = Event::where("start_date", ">=", $carbon->startOfYear()->format("Y-m-d"))
                    ->where("end_date", "<=", $carbon->endOfYear()->format("Y-m-d"))
                    ->orderBy("start_date", "asc")
                    ->get();

        return view("events")
                ->with("week", $w)
                ->with("month", $m)
                ->with("year", $y)
                ->with("carbon", Carbon::now("Australia/Melbourne"));   // using carbon->format() is destructive, so create a new instance
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


    public function sendEmail(Request $request)
    {
        $title = $request->name . ' ' . $request->surname ;
        $email = $request->email;
        $phone = $request->phone;
        $content = $request->message;
        Mail::send('emails.send', ['title' => $title, 'email' => $email, 'phone' => $phone,'content' => $content], function ($message)
        {
            $message->subject('Enquiry');

            $message->from('comment@gmail.com', 'Enquiry Box');

            $message->to(env('MAIL_TO'));

        });


        return redirect()->route("index")->with(Messages::SUCCESS, Messages::CONTACT[Messages::SUCCESS]);
    }
}
