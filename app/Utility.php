<?php

namespace App;

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
}
