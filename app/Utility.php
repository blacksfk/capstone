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
    public static function save($name, $contents, $category=null)
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
     * Takes a string read from file, splits it into lines, 
     * splits the lines into words and matches those words to the model 
     * attributes provided.
     * 
     * @param  array $attrs     Array of model attributes to match values to
     * @param  string $string   String of files read from a csv file
     * @param  string $delim    Characters to split the words on
     * @return array            Associative array with the model attributes as key and the extracted word as value
     */
    public static function splitLinesIntoArray($attrs, $string, $delim)
    {
        $values = [];
        $words = explode($delim, $string);
        $key = 0;

        // if there are more words than model attrs then throw an exception 
        if (count($words) > count($attrs))
        {
            throw new \Exception("Your file has more values than there are fields.");
        }

        foreach ($words as $val)
        {
            $values[$attrs[$key++]] = trim($val);
        }

        return $values;
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
}
