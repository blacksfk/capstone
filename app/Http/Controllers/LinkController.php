<?php

namespace App\Http\Controllers;

use App\Link;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;

class LinkController extends Controller
{
    private static $validation = [
        "name" => "required",
        "active" => "required"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.links.index")->with("links", Link::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.links.create")->with("links", Link::all());
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
        Link::create($request->all());

        return redirect()->route("admin.links.index")
            ->with("success", "Link successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.links.edit")
            ->with("link", Link::find($id))
            ->with("links", Link::all());
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
        Link::find($id)->update($request->all());

        return redirect()->route("admin.links.index")
            ->with("success", "Link successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::find($id);
        $update = [];

        if (isset($link->page))
        {
            return redirect()->route("admin.pages.edit", $link->page->id)
                ->with("page", $link->page)
                ->with("errors", $link->name . " is bound to " . $link->page->name .
                        " and cannot be deleted until it is unbound");
        }

        // link is a parent so set all children parent_id fields to null
        foreach ($link->children as $child)
        {
            $child->parent_id = null;
            $child->save();
            $update[] = $child->name . " no longer has a parent link";
        }

        $link->delete();

        return redirect()->route("admin.links.index")
            ->with("success", "Link successfully deleted")
            ->with("update", $update);
    }

    /**
     * Enable all links in the request
     * 
     * @param  Request $request HTTP POST request
     * @return \Illuminate\Http\Response     
     */
    public function massEnable(Request $request)
    {
        // skip _token key (should be first key of array)
        $linksToEnable = Utility::filterOutInvalidKeys($request->all());
        $errors = [];
        $success = [];
        
        foreach ($linksToEnable as $linkID)
        {
            $link = Link::find($linkID);

            if (isset($link->page) || count($link->children))
            {
                $link->enableLink();
                $success[] = $link->name . " enabled successfully";
            }
            else
            {
                $errors[] = $link->name .
                    " has not been bound to a page and cannot be enabled";
            }
        }

        return redirect()->route("admin.links.index")
            ->with("success", $success)
            ->with("errors", $errors);
    }
}
