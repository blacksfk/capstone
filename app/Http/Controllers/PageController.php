<?php

namespace App\Http\Controllers;

use App\Page;
use App\Link;
use App\Asset;
use App\Utility;
use App\Messages;
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
        $warnings = "";

        if (count($links) === 0)
        {
            $warnings = "No links orphan links found, this page will not be displayed until a new link is created";
        }

        session()->flash(Messages::WARNINGS, $warnings);

        /* give the page both links
            to populate the dropdowns with */
        return view("admin.pages.create")
            ->with("links", $links)
            ->with("assetTypes", Asset::TYPES);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagePost $request)
    {
        $content = Page::extractHTML($request->content);
        $content = Page::insertBladeDirectives($request->name, $content);

        // first try to write the file
        try
        {
            Utility::createFile($request->name, $content, resource_path("views"));
        }
        catch (\Exception $e)
        {
            return back()->withInput()->with(Messages::ERRORS, "Unable to create file: " . $e->getMessage());
        }

        // if successful, create the object in the db
        $page = new Page();
        $page->name = $request->name;
        $page->link_id = $request->link_id;
        $page->save();

        return redirect()->route("admin.pages.index")
            ->with(Messages::SUCCESS, Messages::PAGE[Messages::CREATED]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);

        return view($page->name);
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
        $warnings = "";

        try
        {
            $content = Page::extractHTML(file_get_contents(resource_path("views/" . $page->name . ".blade.php")));
        }
        catch (\Exception $e)
        {
            $warnings = $e->getMessage();
        }

        session()->flash(Messages::WARNINGS, $warnings);

        return view("admin.pages.edit")
            ->with("page", $page)
            ->with("links", $links)
            ->with("content", $content)
            ->with("assetTypes", Asset::TYPES);
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
        $update = "";
        $content = Page::extractHTML($request->content);
        $oldContent = "";

        // first read the file to compare the new input against the old
        try
        {
            $oldContent = Page::extractHTML(file_get_contents(resource_path("views/" . $page->name . ".blade.php")));
        }
        catch (\Exception $e)
        {
            return back()->withInput()->with(Messages::ERRORS, "Unable to open file: " . $e->getMessage());
        }

        // rewrite file or create a new file if name or content has changed
        if ($oldContent !== $request->content || $request->name !== $page->name)
        {
            try 
            {
                $content = Page::insertBladeDirectives($request->name, $request->content);
                Utility::delete(resource_path("views/" . $page->name . ".blade.php"));
                Utility::createFile($request->name, $content, resource_path("views"));
            } 
            catch (\Exception $e)
            {
                return back()->withInput()->with(Messages::ERRORS, "Unable to update file: " . $e->getMessage());
            }
        }

        // set the old link to inactive if link has changed
        if (isset($page->link) && $page->link_id !== $request->link_id)
        {
            Link::find($page->link_id)->active = false;
            $update = $page->link->name . " has been disabled";
        }

        $page->name = $request->name;
        $page->link_id = $request->link_id;
        $page->save();

        return redirect()->route("admin.pages.index")
            ->with(Messages::SUCCESS, Messages::PAGE[Messages::UPDATED])
            ->with(Messages::UPDATED, $update);
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
        $update = "";
        $warnings = "";

        // try to delete the file on disk
        try
        {
            Utility::delete(resource_path("views/" . $page->name . ".blade.php"));
        }
        catch (\Exception $e)
        {
            $warnings = $e->getMessage();
        }

        // disable link the page is bound to
        if (isset($page->link))
        {
            Link::find($page->link_id)->active = false;
            $update = $page->link->name . " link is no longer active";
        }

        $page->delete();

        return redirect()->route("admin.pages.index")
            ->with(Messages::SUCCESS, Messages::PAGE[Messages::DELETED])
            ->with(Messages::UPDATED, $update)
            ->with(Messages::WARNINGS, $warnings);
    }

    /**
     * AJAX only method to create a preview for a file
     * @param  Request $request
     * @return JSON           A JSON object with errors (if they occured)
     */
    public function preview(Request $request)
    {
        $html = Page::extractHTML($request->content);
        $blade = Page::insertBladeDirectives($request->name, $html);

        /* in order to process the blade directives for previewing,
            write to the preview file */
        try
        {
            Utility::createFile("preview", $blade, resource_path("views/admin/pages/"));
        }
        catch (\Exception $e)
        {
            return json_encode([Messages::ERRORS => "Unable to create preview: " . $e->getMessage()]);
        }

        return json_encode(["html" => view("admin.pages.preview")->render()]);
    }
}
