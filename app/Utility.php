<?php


use Illuminate\Http\Request;

use App\Http\Requests;

class Utility
{
    public function save(request $request)
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
        $filename = resource_path()."/views/".$request["category"]."/".$request["page_name"].'.blade.php';

        // attempt to open or write the file
        $myfile = fopen($filename,"w")or die("can't open file");
        $txt = "@extends('layouts.master')
@section('title', 'Welcome')
@section('content')
<div class=\"row text-center\">". $request["contents"]."</div>
    @endsection";
        fwrite($myfile, $txt);
        fclose($myfile);

        // return test view to see if page is successfully created and that all values are passed
        return view("test", compact('request'));
    }
}
