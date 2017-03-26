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
Route::get("/curriculum/literacy", function() {return view("curriculum.literacy");});
Route::get("/curriculum/numeracy", function() {return view("curriculum.numeracy");});
Route::get("/curriculum/digital_technologies", function() {return view("curriculum.digital_technologies");});
Route::get("/events", "Controller@events");
Route::get("/involve", function() {return view("involve");});
Route::get("/contact", function() {return view("contact");});
Route::get("/kids", function() {return view("kids");});
Route::get("/parents", function() {return view("parents");});
Route::get("/teachers", function() {return view("teachers");});

Route::group(["middleware" => "auth"], function() {
    // dump auth only routes here
});

Route::group(["prefix" => "admin"], function() {
    Route::resource("events", "EventController");
});
