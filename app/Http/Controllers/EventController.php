<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Utility;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all()->sortBy("date");

        return view("admin.events.index")->with("events", $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.events.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
            "date" => "required",
        ]);

        Event::create($request->all());

        return redirect()->route("admin.events.index")->with("success", "Event created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);

        return view("admin.events.edit")->with("event", $event);
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
        $this->validate($request, [
            "name" => "required",
            "date" => "required",
        ]);

        Event::find($id)->update($request->all());

        return redirect()->route("admin.events.index")->with("success", "Event updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();

        return redirect()->route("admin.events.index")->with("success", "Event deleted successfully");
    }

    public function previewFile(Request $request)
    {
        if (!$request->file("events")->isValid())
        {
            return json_encode(["errors" => "File is not valid"]);
        }

        $file = fopen($request->file("events"), "r");
        $events = [];

        while (!feof($file))
        {
            $events[] = Utility::splitLinesIntoArray(Event::attributesToArray(), fgets($file), ",");
        }

        return json_encode($events);
    }

    public function batchUpload(Request $request)
    {

    }
}
