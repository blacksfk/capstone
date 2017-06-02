<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Utility;
use Illuminate\Http\Request;
use App\Http\Requests\AssetPost;

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
            ->with("assets", Asset::all());
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
        $request->asset->storeAs(
            $request->type,
            $request->asset->getClientOriginalName(),
            "public"
        );

        $asset = new Asset();
        $asset->name = $request->asset->getClientOriginalName();
        $asset->type = $request->type;
        $asset->save();

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

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssetPost $request, $id)
    {

        $asset = Asset::find($id);
        $asset->name = $request->asset->getClientOriginalName();
        $asset->type = $request->type;
        $asset->save();

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
        $errors = "";

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
            $errors = "Unable to delete " . $asset->name . " from disk. " . $e->getMessage();
        }

        // if succesful, now delete the model
        $asset->delete();

        return redirect()->route("admin.assets.index")
            ->with("success", "Asset deleted successfully")
            ->with("errors", $errors);
    }
}
