<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Utility;
use App\Http\Requests\EventPost;
use App\Messages;

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
    public function store(EventPost $request)
    {

        $event = new Event();
        $event->name = $request->name;
        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->notes = $request->notes;
        $event->save();

        return redirect()->route("admin.events.index")
            ->with(Messages::SUCCESS, Messages::EVENT[Messages::CREATED]);
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
        return view("admin.events.edit")->with("event", Event::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventPost $request, $id)
    {

        $event = Event::findOrFail($id);
        $event->name = $request->name;
        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->notes = $request->notes;
        $event->save();


        return redirect()->route("admin.events.index")
            ->with(Messages::SUCCESS, Messages::EVENT[Messages::UPDATED]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route("admin.events.index")
            ->with(Messages::SUCCESS, Messages::EVENT[Messages::DELETED]);
    }

    /**
     * Iterates through the provided file, creates event objects and then
     * previews them to the user for confirmation
     * 
     * @param  Request $request An HTTP post request
     * @return View           A view to preview the created events
     */
    public function previewFile(Request $request)
    {
        if (!$request->file("events")->isValid())
        {
            return redirect()->route("admin.events.uploadFile")
                ->with("errors", "Invalid file");
        }

        $path = $request->events->store("temp");
        $path = storage_path("app/" . $path);    // fucking quick hack to get this fucking error fixed

        $data = null;

        try
        {
            $data = Utility::readCSVFile($path, "App\Event");
        }
        catch (\Exception $e)
        {
            return redirect()->route("admin.events.index")
                ->with(Messages::ERRORS, "Unable to open file: " . $e);
        }

        $events = $data["objects"];
        $warnings = $data["warnings"];
        $errors = "";

        // remove teh temporary file
        try
        {
            Utility::delete($path);
        }
        catch (\Exception $e)
        {
            $warnings[] = "Could not remove temporary events file: " . $e;
        }

        if (!count($events))
        {
            $errors = "No events loaded";
        }

        /* errors are found via the session, and since this route returns
            a view, session variables cannot be set using the ->with()
            syntax, so flash() them instead */
        $request->session()->flash(Messages::ERRORS, $errors);
        $request->session()->flash(Messages::WARNINGS, $warnings);

        return view("admin.events.previewFile")->with("events", $events);
    }

    /**
     * This creates the events that have been deemed to be valid by the
     * user in the preview page and removes all of the old events!
     * 
     * @param  Request $request An HTTP post request
     * @return \Illuminate\Http\Response
     */
    public function batchUpload(Request $request)
    {
        if (!count($request->events))
        {
            return redirect()->route("admin.events.index")
                ->with(Messages::ERRORS, "No events to upload");
        }

        $success = [];

        // delete all of the exisitng events
        foreach (Event::all() as $event)
        {
            $success[] = $event->name . " deleted successfully";
            $event->delete();
        }

        foreach ($request->events as $event)
        {
            $created = Event::create($event);
            $success[] = $created->name . " inserted successfully";
        }

        return redirect()->route("admin.events.index")
            ->with(Messages::SUCCESS, $success);
    }
}
