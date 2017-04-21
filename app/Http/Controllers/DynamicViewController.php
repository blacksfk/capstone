<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests;

class DynamicViewController extends Controller
{
    public function show($page_name = "home")
    {
        $page = Page::where("name", $page_name)->first();

        if (!isset($page))
        {
            return redirect("/");
        }

        return view("dynamic")->with("page", $page);
    }
}
