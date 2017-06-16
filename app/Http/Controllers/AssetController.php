<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Utility;
use App\Messages;
use App\Http\Requests\AssetPost;
use App\Http\Requests\AssetUpdate;
use Illuminate\Http\Request;

class AssetController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.assets.index")
            ->with("assets", Asset::all())
            ->with("types", Asset::TYPES);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.assets.create")->with("types", Asset::TYPES);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetPost $request)
    {
        $asset = new Asset();
        $asset->name = $request->asset->getClientOriginalName();
        $asset->type = $request->type;
        $asset->save();

        $request->asset->storeAs(
            $request->type,
            $request->asset->getClientOriginalName(),
            "public"
        );

        return redirect()->route("admin.assets.index")
            ->with(Messages::SUCCESS, Messages::ASSET[Messages::CREATED]);
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
        return view("admin.assets.edit")->with("asset", Asset::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssetUpdate $request, $id)
    {
        $asset = Asset::findOrFail($id);

        /**
         * prevent the user from modifying the file extension by matching
         * everything before the file extension, and then setting the
         * filename as the new name + old extension
         */
        $name = $request->name;
        $match = preg_match("/^(?P<name>[^\.]+)/", $name, $matches);

        if ($match)
        {
            $name = $matches["name"];
        }

        $name .= "." . pathinfo(public_path("assets/" . $asset->type . "/" . $asset->name), PATHINFO_EXTENSION);

        try
        {
            Utility::move(public_path("assets/" . $asset->type . "/" . $asset->name), public_path("assets/" . $asset->type . "/" . $name));
        }
        catch (\Exception $e)
        {
            return back()->withInput()->with(Messages::ERRORS, $e->getMessage());
        }

        $asset->name = $name;
        $asset->save();

        return redirect()->route("admin.assets.index")
            ->with(Messages::SUCCESS, Messages::ASSET[Messages::UPDATED]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $warnings = "";

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
            $warnings = "Unable to delete " . $asset->name . " from disk. " . $e->getMessage();
        }

        // if succesful, now delete the model
        $asset->delete();

        return redirect()->route("admin.assets.index")
            ->with(Messages::SUCCESS, Messages::ASSET[Messages::DELETED])
            ->with(Messages::WARNINGS, $warnings);
    }

    /**
     * AJAX only method to return all assets based on the type provided
     * 
     * @param  Request $request
     * @return JSON
     */
    public function getAssetsByType(Request $request)
    {
        return json_encode(Asset::where("type", $request->type)->orderBy("name")->get());
    }
}
