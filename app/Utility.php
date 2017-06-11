<?php

namespace App;

class Utility
{
    /**
     * Saves a file to the specified directory (views only)
     * @param  string $name     The file name
     * @param  string $contents The file content
     * @param  string $path     The directory to save into
     * @return void
     */
    public static function createFile($name, $contents, $path, $ext = ".blade.php")
    {
        $filename = $path . "/" . $name . $ext;
        $myfile = null;

        // create the directory if it doesn't exist
        if (!file_exists($path) && !mkdir($path, 0755))
        {
            throw new \Exception("Could not create directory: " . $path);
        }        

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

        return ["path" => $filename, "name" => $name . $ext];
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

    /**
     * Creates a CSV file of all records belonging to a model
     * 
     * @param  Class $model The model to backup
     * @return array        Array of lines containing values
     */
    public static function createCSVArray($model)
    {
        $objects = $model::all();
        $lines = [];

        foreach ($objects as $object)
        {
            $fillables = $object->getFillable();
            $line = "";

            for ($i = 0; $i < count($fillables); $i++)
            {
                $line .= $object{$fillables[$i]};

                if ($i < count($fillables) - 1)
                {
                    $line .= ",";
                }
            }

            $lines[] = $line;
        }

        return $lines;
    }

    /**
     * Reads and creates objects of the model specified from the CSV file
     * 
     * @param  string $path  Path to the CSV file
     * @param  Class $model  Class to create objects of
     * @return array         An associative array of objects created and any warnings
     */
    public static function readCSVFile($path, $model)
    {
        $file = null;
        $objects = [];
        $warnings = [];
        $lc = 1;

        try
        {
            $file = fopen($path, "r");
        }
        catch (\Exception $e)
        {
            throw $e;
        }

        while (!feof($file))
        {
            // prevent from reading invalid lines
            if ($line = fgets($file)) 
            {
                try
                {
                    $objects[] = self::splitLinesIntoArray($model, $line, ",");
                }
                catch (\Exception $e)
                {
                    $warnings[] = "Line: " . $lc . ". " . $e->getMessage();
                }

                $lc++;
            }
        }

        fclose($file);

        return ["objects" => $objects, "warnings" => $warnings];
    }

    /**
     * Scans a directory and optionally filters files files 
     * not matching the pattern
     * 
     * @param  string  $path    Path to the directory
     * @param  boolean $filter
     * @param  string  $pattern The files must match this pattern to be accepted
     * @return array           An array of file names
     */
    public static function scanDirectory($path, $filter = false, $pattern = "/\.zip$/")
    {
        $files = null;

        if (is_dir($path))
        {
            $files = scandir($path);
        }
        else
        {
            throw new \Exception("Not a valid directory");
        }

        if ($filter)
        {
            $length = count($files);    // unset modifies the length of the array
            for ($i = 0; $i < $length; $i++)
            {
                if (!preg_match($pattern, $files[$i]))
                {
                    unset($files[$i]);
                }
            }
        }

        return $files;
        
    }

    /**
     * Capitalises the first letters of every word in the string
     * @param  string $string
     * @return string
     */
    public static function capitaliseFirstLetters($string)
    {
        $words = explode(" ", $string);
        $returnString = "";

        foreach ($words as $word)
        {
            $letters = str_split($word);
            $letters[0] = strtoupper($letters[0]);
            $returnString .= implode($letters) . " ";
        }

        // trim the trailing space
        return trim($returnString);
    }
}
