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
Auth::routes();

Route::get('/', function () { return view("home"); });
Route::get("/curriculum", function() {return view("curriculum");});
Route::get("/events", "Controller@events");
Route::get("/contact", function() {return view("contact");});
Route::get("/faq", function() {return view("faq");});
Route::get("/noscript", function() {return view("noscript");});

// Under the 'Curriculum' dropdown
Route::group(["prefix" => "curriculum"], function() {
    Route::get("literacy", function() {return view("curriculum.literacy");});
    Route::get("numeracy", function() {return view("curriculum.numeracy");});
    Route::get("digital_technologies", function() {return view("curriculum.digital_technologies");});
    Route::get("multimedia", function() {return view("curriculum.multimedia");});
    Route::get("esmart", function() {return view("curriculum.esmart");});
    Route::get('/enrolment', function() {return view("curriculum.enrolment");});
    Route::get('newsletters', "Controller@newsletters");
});

// Under the 'About Us' dropdown
Route::group(["prefix" => "about"], function() {
    Route::get("principal", function() {return view("about.principal");});
    Route::get("policies", function() {return view("about.policies");});
});

// Under the 'Get Involved' dropdown

Route::group(["prefix" => "involve"], function() {
    Route::get("kids", function() {return view("involve.kids");});
    Route::get("parents", function() {return view("involve.parents");});
    Route::get("teachers", function() {return view("involve.teachers");});
    Route::get("enrolment", function() {return view("involve.enrolment");});
});

Route::group(["as" => "admin.", "prefix" => "admin", "middleware" => "auth"], function() {
    // custom routes for events for batch upload
    Route::get("events/uploadFile", function() {
        return view("admin.events.uploadFile");
    })->name("events.uploadFile");

    Route::post("events/previewFile", [
        "as" => "events.previewFile",
        "uses" => "EventController@previewFile"
    ]);

    Route::post("events/batchUpload", [
        "as" => "events.batchUpload",
        "uses" => "EventController@batchUpload"
    ]);

    Route::resource("events", "EventController");
    Route::resource("assets", "AssetController");

    // custom method for retrieving a templates section
    Route::get("templates/sections", [
        "as" => "templates.sections",
        "middleware" => "ajax",
        "uses" => "TemplateController@getSections"
    ]);
    Route::resource("templates", "TemplateController");

    // custom controller method - put before resource!
    Route::post("admin/links/toggle", [
        "as" => "links.toggle",
        "uses" => "LinkController@toggle"
    ]);
    Route::resource("links", "LinkController");

    // custom route for previewing a page
    Route::get("pages/preview", [
        "as" => "pages.preview",
        "middleware" => "ajax",
        "uses" => "PageController@preview"
    ]);
    Route::resource("pages", "PageController");
});

// Dynamic routing to custom pages
Route::get("/{page_name}", "Controller@dynamic")->name("dynamic.show");