<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();

        return view("admin.pages.index")->with("pages", $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.create");
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
            "status" => "required"
        ]);

        // store the page in the database
        Page::create($request->name, $request->status);
        
        // TODO: call function to save the content from the request to file
        // Utilities::writeToFile($request->content);

        return redirect()->route("admin.pages.index")->with("success", "Page created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id);

        return view("admin.pages.show")->with("page", $page);
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

        // TODO: read the file and a content variable to the page object
        // Utilities::getContentFromFile($page->path);

        return view("admin.pages.edit")->with("page", $page);
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
            "status" => "required"
        ]);

        $page = Page::find($id)->update($request->all());

        // TODO: update the physical file with the new content (rewrite the file)
        // Utilities::writeToFile($request->content());

        return view("admin.pages.index")->with("success", "Page updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pages::find($id)->delete();

        return view("admin.pages.index")->with("success", "Page deleted successfully");
    }
}
