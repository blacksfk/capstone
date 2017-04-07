<?php

namespace App\Http\Controllers;

use App\Page;
use App\Link;
use Illuminate\Http\Request;
use App\Http\Requests;

class PageController extends Controller
{
    private static $validation = [
        "name" => "required",
        "link_id" => "required",
        "content" => "required"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.index")->with("pages", Page::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // send all the links to the view for dropdown population
        $links = Link::all();

        if (count($links) === 0)
        {
            return redirect()->route("admin.links.create")->with("errors", "No links found, please create one here first");
        }
        return view("admin.pages.create")->with("links", $links);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, self::$validation);
        Page::create($request->all());
        
        // TODO: call function to save the content from the request to file
        // Utilities::writeToFile($request->content);

        return redirect()->route("admin.pages.index")->with("success", "Page created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $links = Link::all();

        return view("admin.pages.edit")->with("page", $page)->with("links", $links);
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
        $this->validate($request, self::$validation);
        $page = Page::find($id)->update($request->all());

        // TODO: update the physical file with the new content (rewrite the file)
        // Utilities::writeToFile($request->content());

        return redirect()->route("admin.pages.index")->with("success", "Page updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::findOrFail($id)->delete();

        return redirect()->route("admin.pages.index")->with("success", "Page deleted successfully");
    }
}
