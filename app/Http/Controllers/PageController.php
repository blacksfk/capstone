<?php

namespace App\Http\Controllers;

use App\Page;
use App\Link;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Requests\PagePost;

class PageController extends Controller
{
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
        // get links which are not bound
        $links = Link::getOrphanLinks();

        if (count($links) === 0)
        {
            return redirect()->route("admin.links.create")
                ->with("errors", "No links found, please create one here");
        }

        /* give the page both links
            to populate the dropdowns with */
        return view("admin.pages.create")
            ->with("links", $links);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagePost $request)
    {
        $content = "@extends('layouts.master')\n";
        $content .= "@section('title', " . $request->name . ")\n";
        $content .= "@section('content')\n";
        $content .= $request->content . "\n";
        $content .= "@endsection\n";

        // first try to write the file
        try
        {
            Utility::createFile($request->name, $content, resource_path("views"));
        }
        catch (\Exception $e)
        {
            return back()->withInput()->with("errors", "Unable to create file: " . $e->getMessage());
        }

        // if successful, create the object in the db
        $page = new Page();
        $page->name = $request->name;
        $page->link_id = $request->link_id;
        $page->save();

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
        $page = Page::findOrFail($id);
        $links = Link::getOrphanLinks();
        $content = null;

        try
        {
            $content = file_get_contents(resource_path("views/" . $page->name . ".blade.php"));
        }
        catch (\Exception $e)
        {
            return redirect()->route("admin.pages.index")->with("errors", "Unable open file: " . $e->getMessage());
        }

        return view("admin.pages.edit")
            ->with("page", $page)
            ->with("links", $links)
            ->with("content", $content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagePost $request, $id)
    {
        $page = Page::findOrFail($id);
        $update = [];
        $oldContent = null;

        try
        {
            $oldContent = file_get_contents(resource_path("views/" . $page->name . ".blade.php"));
        }
        catch (\Exception $e)
        {
            return back()->withInput()->with("errors", "Unable to open file: " . $e->getMessage());
        }

        if ($oldContent !== $request->content)
        {
            try 
            {
                Utility::createFile($page->name, $request->content, resource_path("views/"));       
            } 
            catch (\Exception $e)
            {
                return back()->withInput()->with("errors", "Unable to update file: " . $e->getMessage());
            }
        }

        // set the old link to inactive if link has changed
        if (isset($page->link) && $page->link_id !== $request->link_id)
        {
            Link::find($page->link_id)->active = false;
            $update[] = $page->link->name . " has been disabled";
        }

        $page->name = $request->name;
        $page->link_id = $request->link_id;
        $page->save();

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
        $page = Page::findOrFail($id);
        $update = [];

        // try to delete the file on disk
        try
        {
            Utility::delete(resource_path("views/" . $page->name . ".blade.php"));
        }
        catch (\Exception $e)
        {
            return back()->with("errors", "Unable to delete file: " . $e->getMessage());
        }

        // disable link the page is bound to
        if (isset($page->link))
        {
            Link::find($page->link_id)->active = false;
            $update[] = $page->link->name . " is no longer active";
        }

        $page->delete();

        return redirect()->route("admin.pages.index")
            ->with("success", "Page deleted successfully")
            ->with("update", $update);
    }

    /**
     * Ajax only method to build and return a view for previewing
     * @param  Request $request HTTP GET request
     * @return String           A string of HTML built with the view helper
     */
    public function preview(Request $request)
    {
        // extract only the html between the blade section tags for previewing
        preg_match("/@section\('.+'\)(?P<content>[\s\S]*)@endsection/", $request->content, $matches);
        $view = view("admin.pages.preview")
            ->with("name", $request->name)
            ->with("content", $matches["content"])
            ->render();

        return $view;
    }
}
