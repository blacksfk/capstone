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

Route::get('/', function () { return view("home");})->name('index');
Route::get("events", "HomeController@events");
Route::get("contact", function() {return view("contact");});
Route::get("newsletters", "HomeController@newsletters");
Route::get("/noscript", function() {return view("noscript");});

Route::group(["as" => "admin.", "prefix" => "admin", "middleware" => "auth"], function() {

    /* =================================================
        Custom resource controller methods
        Must be declared before resource() declaration
      ================================================*/

    // event batch upload
    Route::get("events/uploadFile", function() {
        return view("admin.events.uploadFile");
    })->name("events.uploadFile");

    // preview events before inserting
    Route::post("events/previewFile", [
        "as" => "events.previewFile",
        "uses" => "EventController@previewFile"
    ]);

    // upload events from file
    Route::post("events/batchUpload", [
        "as" => "events.batchUpload",
        "uses" => "EventController@batchUpload"
    ]);

    // toggle links
    Route::post("admin/links/toggle", [
        "as" => "links.toggle",
        "uses" => "LinkController@toggle"
    ]);

    // preview a page - AJAX only
    Route::get("pages/preview", [
        "as" => "pages.preview",
        "middleware" => "ajax",
        "uses" => "PageController@preview"
    ]);


    /* ==============================================
        Resource controllers
       ============================================*/
    Route::resource("assets", "AssetController");
    Route::resource("carousel", "CarouselController");
    Route::resource("events", "EventController");
    Route::resource("links", "LinkController");
    Route::resource("pages", "PageController");
});

// Dynamic routing to custom pages
Route::get("/{page_name}", "HomeController@dynamic")->name("dynamic.show");