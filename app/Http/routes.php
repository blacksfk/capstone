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
Route::get("/curriculum", function() {return view("curriculum");});
Route::get("/events", "Controller@events");
Route::get("/contact", function() {return view("contact");});

// TEST
//Route::get('/test2',function () { return view("curriculum.TEST_PAGE_CREATION"); });
Route::get('/test1',"FileSaveController@save");
Route::get('/test', function () { return view("test"); });

// Under the 'Curriculum' dropdown
Route::group(["prefix" => "curriculum"], function() {
    Route::get("literacy", function() {return view("curriculum.literacy");});
    Route::get("numeracy", function() {return view("curriculum.numeracy");});
    Route::get("digital_technologies", function() {return view("curriculum.digital_technologies");});
});

// Under the 'Get Involved' dropdown

Route::group(["prefix" => "involve"], function() {
    Route::get("kids", function() {return view("involve.kids");});
    Route::get("parents", function() {return view("involve.parents");});
    Route::get("teachers", function() {return view("involve.teachers");});
});


Route::group(["middleware" => "auth"], function() {
    // dump auth only routes here
});

Route::group(["prefix" => "admin"], function() {
    Route::get("/", function() { return view("admin.dashboard"); });
    
    Route::resource("events", "EventController");
    Route::resource("pages", "PageController");

    // custom controller method - put before resource!
    Route::post("links/massEnable", "LinkController@massEnable");
    Route::resource("links", "LinkController");
});
