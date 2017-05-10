<?php

namespace App\Http\Controllers;

use DB;
use App\Page;
use App\Link;
use App\Template;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;

class PageController extends Controller
{
    private static $validation = [
        "name" => "required",
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
        $links = $this->getOrphanLinks();

        if (count($links) === 0)
        {
            return redirect()->route("admin.links.create")
                ->with("errors", "No links found, please create one here");
        }

        /* give the page both links and templates
            to populate the dropdowns with */
        return view("admin.pages.create")
            ->with("links", $links)
            ->with("templates", Template::all());
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

        return redirect()->route("admin.pages.index")
            ->with("success", "Page created successfully");
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
        $links = $this->getOrphanLinks();
        $templates = Template::all();

        return view("admin.pages.edit")
            ->with("page", $page)
            ->with("links", $links)
            ->with("templates", $templates);
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
        $page = Page::find($id);
        $update = [];

        // set the old link to inactive if link has changed
        if (isset($page->link) && $page->link_id !== $request->link_id)
        {
            Link::find($page->link_id)->active = false;
            $update[] = $page->link->name . " has been disabled";
        }

        $page->update($request->all());

        return redirect()->route("admin.pages.index")
            ->with("success", "Page updated successfully")
            ->with("update", $update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $update = [];

        // disable link the page is bound to
        if (isset($page->link))
        {
            Link::find($page->link_id)->disableLink();
            $update[] = $page->link->name . " is no longer active";
        }

        $page->delete();

        return redirect()->route("admin.pages.index")
            ->with("success", "Page deleted successfully")
            ->with("update", $update);
    }

    /**
     * Get all links which aren't bound to pages
     * @return array Collection of link objects
     */
    private function getOrphanLinks()
    {
        return DB::table("links")->whereNotIn("id", function($query) {
            $query->select(DB::raw("link_id"))->from("pages");
        })->get();   
    }

    /**
     * Ajax only method to build and return a view for previewing
     * @param  Request $request HTTP GET request
     * @return String           A string of HTML built with the view helper
     */
    public function preview(Request $request)
    {
        $template = Template::find($request->id);
        $view = view("admin.pages.preview")
            ->with("template", $template)
            ->with("name", $request->name)
            ->with("content", json_decode($request->content)) // should be a json string
            ->render();

        return $view;
    }
}
