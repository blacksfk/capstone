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
        return view("admin.assets.create")->with("types", Asset::$assetTypes);
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
        $ext = "";

        if ($request->file("asset")->isValid())
        {
            $dir = public_path("assets/" . $request->type);
            $ext = $request->file("asset")->guessExtension();

            if (!file_exists($dir))
            {
                $result = mkdir($dir, 0755);

                if (!$result)
                {
                    return back()->withInput()
                        ->with("errors", "Unable to create directory");
                }
            }

            // change the file name to the name and move to assets directory
            try 
            {
                $request->file("asset")->move(
                    $dir, 
                    $request->name . "." . $ext
                );
            }
            catch (FileException $e)
            {
                return back()->withInput()
                    ->with("errors", "Could not move file: " . $e->getMessage());
            }
        }

        Asset::create([
            "name" => $request->name . "." . $ext,
            "type" => $request->type
        ]);

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
            ->with("asset", Asset::find($id))
            ->with("types", Asset::$assetTypes);
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
