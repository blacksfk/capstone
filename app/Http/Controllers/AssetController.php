<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;

class AssetController extends Controller
{
    private static $validation = [
        "name" => "required|max:255|unique:assets",
        "type" => "required"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.assets.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.assets.create");
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

        dd($request->file("photo"));

        Asset::create($request->all());

        return redirect()->route("admin.assets.index")
            ->with("success", "Asset uploaded successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.assets.edit")
            ->with("asset", Asset::find($id));
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
        Asset::find($id)->update($request->all());

        return redirect()->route("admin.assets.index")
            ->with("success", "Asset updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::find($id);

        // first try to delete the asset
        try
        {
            /* construct path to public/assets/asset_type/asset_name
                with public_path() helper */
            Utility::delete(
                public_path("assets/" . $asset->type . "/" . $asset->name)
            );
        }
        catch (\Exception $e)
        {
            return back()
                ->withInput()
                ->with("errors", 
                    "Unable to delete " . $asset->name . ". " . $e->getMessage()
                );
        }

        // if succesful, now delete the model
        $asset->delete();

        return redirect()->route("admin.assets.index")
            ->with("success", "Asset deleted successfully");
    }
}
