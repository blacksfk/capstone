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
Route::get("newsletters", "HomeController@newsletters");
Route::get("/noscript", function() {return view("noscript");});

Route::group(["as" => "admin.", "prefix" => "admin", "middleware" => "auth"], function() {

    /*==================================================
       CUSTOM RESOURCE CONTROLLER METHODS
       Must be declared before resource()
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
    Route::post("pages/preview", [
        "as" => "pages.preview",
        "middleware" => "ajax",
        "uses" => "PageController@preview"
    ]);

    /*================================================
       BACKUP CONTROLLER
      ==============================================*/

    // index function
    Route::get("backups/index", [
        "as" => "backups.index",
        "uses" => "BackupController@index"
    ]);

    // show the form for upload a zip
    Route::get("backups/create", [
        "as" => "backups.create",
        "uses" => "BackupController@create"
    ]);

    // upload and overwrite
    Route::post("backups/upload", [
        "as" => "backups.upload",
        "uses" => "BackupController@upload"
    ]);

    // preview the contents of the zip
    Route::get("backups/preview/{name}", [
        "as" => "backups.preview",
        "uses" => "BackupController@preview"
    ]);

    // creates a backup of all files and records
    Route::post("backups/backup", [
        "as" => "backups.backup",
        "uses" => "BackupController@backup"
    ]);

    // restores the selected backup
    Route::post("backups/restore/{name}", [
        "as" => "backups.restore",
        "uses" => "BackupController@restore"
    ]);

    // delete the selected backup
    Route::delete("backups/destroy/{name}", [
        "as" => "backups.destroy",
        "uses" => "BackupController@destroy"
    ]);


    /*==============================================
       RESOURCE CONTROLLERS
      ============================================*/
    Route::resource("assets", "AssetController");
    Route::resource("carousel", "CarouselController");
    Route::resource("events", "EventController");
    Route::resource("links", "LinkController");
    Route::resource("pages", "PageController");
});

// Dynamic routing to custom pages
Route::get("/{name}", "HomeController@dynamic")->name("dynamic.show");