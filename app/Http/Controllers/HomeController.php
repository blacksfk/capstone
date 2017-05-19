<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utility;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function output()
    {
        $results =  Utility::scanDirectory();



        return view("test")
            ->with("results", $results);
    }
}
