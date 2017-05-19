<?php

namespace App;

use Illuminate\Http\Request;
use App\Http\Requests;

class Utility
{
    /**
     * Saves a files to the views directory (blade.php only for now)
     * @param  string $name     name of the file
     * @param  string $contents the file's contents
     * @param  string $category directory path
     */
    public static function createFile($name, $contents, $category=null)
    {
        // compiles the path, leads to views folder (specifiy the folder), (specify the name)
        $filename = resource_path()."/views/".$category."/".$name.'.blade.php';
        $myfile = null;

        // attempt to open the file
        try
        {
            $myfile = fopen($filename, "w");
        }
        catch (\Exception $e)   // Need to escape current namespace to global namespace
        {
            throw $e;
        }
        
        // now attempt to write to the file
        try
        {
            fwrite($myfile, $contents);
        }
        catch (\Exception $e)
        {
            throw $e;
        }

        fclose($myfile);
    }

    /**
     * Deletes files on disk. Make sure to handle the exception!!
     * @param  string $pathToFile The absolute path to the resource!
     */
    public static function delete($pathToFile)
    {
        try
        {
            unlink($pathToFile);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * Filters out keys which start with an underscore and 
     * returns the rest of the array
     * 
     * @param  Array $array An associative array
     * @return Array        An associative array without invalid keys
     */
    public static function filterOutInvalidKeys($array)
    {
        return array_filter($array, function($key) {
            preg_match("/^[^_].*/", $key, $matches);
            return $matches;
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Creates an object of the class given by splitting the string on
     * the delim (assumed that these are the values to be created).
     * Throws an exception if there are more values than there
     * are attributes, so make sure to handle it!
     * 
     * @param  Class $class     The class to create an object of
     * @param  string $string   The string that contains the values to extract
     * @param  string $delim    The delimiter to split the string on
     * 
     * @return object           An object of the class specified
     */
    public static function splitLinesIntoArray($class, $string, $delim)
    {
        $values = [];
        $words = explode($delim, $string);
        $object = new $class();
        $fillables = $object->getFillable();

        // if there are more words than model attrs then throw an exception 
        if (count($words) > count($fillables))
        {
            throw new \Exception("Found more values than fillable fields.");
        }

        for ($i = 0; $i < count($fillables); $i++)
        {
            $object->{$fillables[$i]} = trim($words[$i]);
        }

        return $object;
    }

    public static function  saveFile(Request $request)
    {
        $dir = public_path("assets/" . $request->type);

        // check if an extension was given in the file name
        if (preg_match("/\.(.+)$/", $request->name))
        {
            $name = $request->name;
        }
        else
        {
            // no extension given in name field so get it from the file
            $name = $request->name . "." . $request->file("asset")->guessExtension();
        }

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
            $request->file("asset")->move($dir, $name);
        }
        catch (FileException $e)
        {
            return back()->withInput()
                ->with("errors", "Could not move file: " . $e->getMessage());
        }

        return $name;
    }

    public static function scanDirectory(){
        $dir = public_path("assets/pdf/test");

        $output = scandir($dir);

        return $output;
    }

}
