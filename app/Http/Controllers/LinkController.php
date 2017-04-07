<?php

namespace App\Http\Controllers;

use App\Link;
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

        return redirect()->route("admin.links.index")->with("success", "Link successfully created");
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

        return redirect()->route("admin.links.index")->with("success", "Link successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::find($id)->delete();

        return redirect()->route("admin.links.index")->with("success", "Link successfully deleted");
    }
}
