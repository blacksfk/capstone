<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FileSaveController extends Controller
{
    public function store()
    {
        /*
        $this->validate($request, [
            "page_name" => "required",
            "category" => "required",
            "content" => "required",
        ]);
        */

        $request = [
            "category" => "curriculum",
            "page_name" => "TEST_PAGE_CREATION",
            "contents" => "FAKE CONTENTS",
        ];

        $filename = resource_path()."/views/".$request["category"]."/".$request["page_name"].'.blade.php';

        $myfile = fopen($filename,"w")or die("can't open file");
        $txt = "@extends('layouts.master')
@section('title', 'Welcome')
@section('content')
<div class=\"row text-center\">". $request["contents"]."</div>
    @endsection";
        fwrite($myfile, $txt);
        fclose($myfile);
        return view("test", compact('request'));
    }
}
