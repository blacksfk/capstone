<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Asset;
use App\CarouselItem;
use App\Event;
use App\Link;
use App\Page;
use App\Utility;
use App\Messages;
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
            $files = Utility::scanDirectory(storage_path("backups"), true);
        }
        catch (\Exception $e)
        {
            $errors = $e->getMessage();
        }

        return view("admin.backups.index")
            ->with("backups", $files)
            ->with(Messages::ERRORS, $errors);
    }

    /**
     * Create a backup of all files and records (as CSVs) 
     * and compress them into a zip
     * 
     * @return \Illuminate\Http\Response
     */
    public function backup(Request $request)
    {
        $now = new \Carbon\Carbon();
        $files = [];
        $warnings = [];
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
                $now . "_" . $model,
                implode("\n", $array),
                storage_path("backups/"),
                ".csv"
            );
        }

        $zip = new ZipArchive();
        $zip->open(storage_path("backups/") . $now . "_backup.zip", ZipArchive::CREATE);

        // save necessary extra files
        foreach (Asset::all() as $asset)
        {
            $file = public_path("assets/" . $asset->type . "/" . $asset->name);
            $zip->addFile($file, "assets/" . $asset->type . "/" . $asset->name);
        }

        foreach (Page::all() as $page)
        {
            $file = resource_path("views/" . $page->name . ".blade.php");
            $zip->addFile($file, "views/" . $page->name . ".blade.php");
        }

        // add the csvs
        foreach ($files as $file)
        {
            $zip->addFile($file["path"], "csvs/" . $file["name"]);
        }

        $zip->close();

        // remove the csvs from disk once the zip is closed
        foreach ($files as $file)
        {
            try
            {
                Utility::delete($file["path"]);
            }
            catch (\Exception $e)
            {
                $warnings[] = $e->getMessage();
            }
        }

        return redirect()->route("admin.backups.index")
            ->with(Messages::SUCCESS, Messages::BACKUP[Messages::CREATED])
            ->with(Messages::WARNINGS, $warnings);
    }

    /**
     * Preview the contents of the zip
     * 
     * @param  string $name The zip file name
     * @return \Illuminate\Http\Response
     */
    public function preview($name)
    {
        $zip = new ZipArchive();
        $files = [];

        try
        {
            $zip->open(storage_path("backups/" . $name));
        }
        catch (\Exception $e)
        {
            return redirect()->route("admin.backups.index")
                ->with(Messages::ERRORS, $e->getMessage());
        }

        for ($i = 0; $i < $zip->numFiles; $i++)
        {
            $files[] = $zip->statIndex($i, ZipArchive::FL_UNCHANGED);
        }

        $zip->close();

        return view("admin.backups.preview")
            ->with("backup", $name)
            ->with("files", $files);
    }

    /**
     * Destroys the entire database and inserts everything in the zip
     * 
     * @param  Request $request
     * @param  string  $name    The zip file name
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $name)
    {
        // use truncate() to delete everything and reset id counter
        Event::truncate();
        CarouselItem::truncate();
        Asset::truncate();
        Page::truncate();
        Link::truncate();

        $ex_path = storage_path("backups/extracted/");
        $zip = new ZipArchive();
        $zip->open(storage_path("backups/" . $name));

        if (!file_exists($ex_path) && !mkdir($ex_path, 0755))
        {
            return redirect()->route("admin.backups.index")
                ->with(Messages::ERRORS, "Could not created directory: " . $path);
        }

        $zip->extractTo($ex_path);
        $zip->close();
        $csvs = [];
        $warnings = [];

        try
        {
            $csvs = Utility::scanDirectory($ex_path . "csvs/", true, "/\.csv$/");
        }
        catch (\Exception $e)
        {
            return redirect()->route("admin.backups.index")
                ->with(Messages::ERRORS, $e->getMessage());
        }

        // loop through each csv and create each object
        // if the object is an asset or model, then copy the resource too
        foreach ($csvs as $csv)
        {
            // php requires at least two backslashes to escape and match a backslash
            preg_match("/_(?P<model>[\w\\\]+).csv$/", $csv, $matches);
            $data = Utility::readCSVFile($ex_path . "csvs/" . $csv, $matches["model"]);
            $objects = $data["objects"];
            $warnings = array_merge($warnings, $data["warnings"]);

            foreach ($objects as $object)
            {
                $object->save();

                // move the asset to the public directory
                if (strtolower($matches["model"]) === "app\asset")
                {
                    try
                    {
                        Utility::move($ex_path . "assets/" . $object->type . "/" . $object->name, public_path("assets/" . $object->type . "/" . $object->name));
                    }
                    catch (\Exception $e)
                    {
                        $warnings[] = $e->getMessage();
                    }
                }
                else if (strtolower($matches["model"]) === "app\page")
                {
                    // move the page to the views directory
                    try
                    {
                        Utility::move($ex_path . "views/" . $object->name . ".blade.php", resource_path("views/" . $object->name . ".blade.php"));
                    }
                    catch (\Exception $e)
                    {
                        $warnings[] = $e->getMessage();
                    }
                }
            }
        }

        // try to remove the extract files
        try
        {
            Utility::deleteDirectory($ex_path);
        }
        catch (\Exception $e)
        {
            $warnings[] = $e->getMessage();
            $warnings[] = "Extracted directory was not removed";
        }

        return redirect()->route("admin.backups.index")
            ->with(Messages::WARNINGS, $warnings)
            ->with(Messages::SUCCESS, "Backup restored");
    }

    /**
     * Delete the selected backup
     * 
     * @param  string $name Name of the backup
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        try
        {
            Utility::delete(storage_path("backups/" . $name));
        }
        catch (\Exception $e)
        {
            return back()->with(Messages::ERRORS, $e->getMessage());
        }

        return redirect()->route("admin.backups.index")
            ->with(Messages::SUCCESS, Messages::BACKUP[Messages::DELETED]);
    }
}
