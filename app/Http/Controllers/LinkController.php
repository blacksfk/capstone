<?php

namespace App\Http\Controllers;

use App\Link;
use App\Utility;
use App\Messages;
use App\ParentLink;
use Illuminate\Http\Request;
use App\Http\Requests\LinkPost;

class LinkController extends Controller
{

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
        return view("admin.links.create")->with("links", Link::getPotentialParents());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkPost $request)
    {
        $link = new Link();
        $link->name = $request->name;
        $link->active = $request->active;
        $link->parent_id = $request->parent_id;
        $link->save();

        return redirect()->route("admin.links.index")
            ->with(Messages::SUCCESS, Messages::LINK[Messages::CREATED]);
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
        $link = Link::findOrfail($id);

        return view("admin.links.edit")
            ->with("link", $link)
            ->with("links", Link::getPotentialParents($link));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkPost $request, $id)
    {
        $link = Link::findOrFail($id);
        $link->name = $request->name;
        $link->active = $request->active;
        $link->parent_id = $request->parent_id;
        $link->save();

        return redirect()->route("admin.links.index")
            ->with(Messages::SUCCESS, Messages::LINK[Messages::UPDATED]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $update = [];

        if (isset($link->page))
        {
            return redirect()->route("admin.pages.edit", $link->page->id)
                ->with("page", $link->page)
                ->with(Messages::ERRORS, $link->name . " is bound to " . $link->page->name .
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
            ->with(Messages::SUCCESS, Messages::LINK[Messages::DELETED])
            ->with(Messages::UPDATED, $update);
    }

    /**
     * Toggles the selected links between active and inactive
     * 
     * @param  Request $request HTTP POST request
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request)
    {
        $enable = $request->_enable;    // set this before filtering
        $linksToEnable = Utility::filterOutInvalidKeys($request->all());
        $errors = [];
        $success = [];

        foreach (array_keys($linksToEnable) as $id)
        {
            $link = Link::findOrFail($id);
            $result = $link->toggle($enable);

            if ($result)
            {
                $success[] = $link->name . 
                    ($enable ? " enabled" : " disabled") . " successfully";
            }
            elseif (!$result && $enable)
            {
                $errors[] = $link->name . 
                    " does not have any active children or has not been bound to a page and cannot be enabled";
            }
        }

        return redirect()->route("admin.links.index")
            ->with(Messages::SUCCESS, $success)
            ->with(Messages::ERRORS, $errors);
    }
}
