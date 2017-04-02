<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () { return view("home"); });
Route::get("/old", function() {return view("welcome");});
Route::get("/curriculum", function() {return view("curriculum");});
Route::get("/events", "Controller@events");
Route::get("/contact", function() {return view("contact");});

// Under the 'Curriculum' dropdown
Route::get("/curriculum/literacy", function() {return view("curriculum.literacy");});
Route::get("/curriculum/numeracy", function() {return view("curriculum.numeracy");});
Route::get("/curriculum/digital_technologies", function() {return view("curriculum.digital_technologies");});

// Under the 'Get Involved' dropdown
Route::get("/involve/kids", function() {return view("involve.kids");});
Route::get("/involve/parents", function() {return view("involve.parents");});
Route::get("/involve/teachers", function() {return view("involve.teachers");});

// to be moved to 'auth only' group
//Route::get("/addpage", function() {return view("admin.custompages.addpage");});

Route::group(["middleware" => "auth"], function() {
    // dump auth only routes here
});

Route::group(["prefix" => "admin"], function() {
    Route::get("/", function() { return view("admin.dashboard"); });
    
    Route::resource("events", "EventController");
    Route::resource("links", "LinkController");
    Route::resource("pages", "PageController");
});
