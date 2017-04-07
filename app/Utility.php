<?php

namespace App;
use Illuminate\Http\Request;

class Utility
{
    public static function save($name, $contents, $category=null)
    {
        /*
         * check request object if empty
        $this->validate($request, [
            "page_name" => "required",
            "category" => "required",
            "content" => "required",
        ]);

           * hard coded request object, might not be needed
        $request = [
            "category" => "curriculum",
            "page_name" => "TEST_PAGE_CREATION",
            "contents" => "FAKE CONTENTS",
        ];
        */

        // compiles the path, leads to views folder (specifiy the folder), (specify the name)
        $filename = resource_path()."/views/".$category."/".$name.'.blade.php';

        // attempt to open or write the file
        $myfile = fopen($filename,"w")or die("can't open file");
        $txt = "@extends('layouts.master')\n" .
        "@section('title', 'Welcome')\n" . 
        "@section('content')\n" .
        "<div class=\"row text-center\">". $contents."</div>\n" . 
        "@endsection";
        fwrite($myfile, $txt);
        fclose($myfile);

        // return test view to see if page is successfully created and that all values are passed
        return view("test", compact('request'));
    }
}
