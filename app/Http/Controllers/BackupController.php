<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Asset;
use App\CarouselItem;
use App\Event;
use App\Link;
use App\Page;
use App\Utility;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = [];
        $errors = "";

        try
        {
            $files = Utility::scanDirectory(storage_path("backups"), true, ".zip");
        }
        catch (\Exception $e)
        {
            $errors = $e;
        }

        return view("admin.backups.index")
            ->with("backups", $files)
            ->with("errors", $errors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Create a backup of all files and records (as CSVs) 
     * and compress them into a zip
     * 
     * @return \Illuminate\Http\Response
     */
    public function backup()
    {
        $now = new \Carbon\Carbon();
        $files = [];
        $models = [
            Asset::class,
            CarouselItem::class,
            Event::class,
            Link::class,
            Page::class
        ];

        // create CSVs
        foreach ($models as $model)
        {
            $array = Utility::createCSVArray($model);
            $files[] = Utility::createFile(
                $now . $model,
                implode("\n", $array),
                storage_path("backups/"),
                ".csv"
            );
        }

        $zip = new ZipArchive();
        $zip->open(storage_path("backups/") . $now . "_backup.zip", ZIPARCHIVE::CREATE);
        // $zip->addEmptyDir("assets");
        // $zip->addEmptyDir("pages");

        // save necessary extra files
        foreach (Asset::all() as $asset)
        {
            $file = public_path("assets/" . $asset->type . "/" . $asset->name);
            $zip->addFile($file);
        }

        foreach (Page::all() as $page)
        {
            $file = resource_path("views/" . $page->name . ".blade.php");
            $zip->addFile($file);
        }

        // add the csvs
        foreach ($files as $file)
        {
            $zip->addFile($file);
        }

        $zip->close();

        return redirect()->route("admin.backups.index");
    }
}
