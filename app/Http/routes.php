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
Route::get("/curriculum", function() {return view("curriculum");});
Route::get("/events", "Controller@events");
Route::get("/contact", function() {return view("contact");});
Route::get("/faq", function() {return view("faq");});
Route::get("/noscript", function() {return view("noscript");});
Route::get('/enrolment', function() {return view("enrolment");});

// Under the 'Curriculum' dropdown
Route::group(["prefix" => "curriculum"], function() {
    Route::get("literacy", function() {return view("curriculum.literacy");});
    Route::get("numeracy", function() {return view("curriculum.numeracy");});
    Route::get('/enrolment', function() {return view("curriculum.enrolment");});
    Route::get('newsletters', "NewsletterController@show");
    Route::get("multimedia", function() {return view("curriculum.multimedia");});
    Route::get("esmart", function() {return view("curriculum.esmart");});
    Route::get("tms", function() {return view("curriculum.tms");});
    Route::get("integrated", function() {return view("curriculum.integrated");});
    Route::get("digital-tech", function() {return view("curriculum.digital-tech");});  
});

// Under the 'parents info' dropdown
Route::group(["prefix" => "parents-info"], function() {
    Route::get("newsletters", "Controller@newsletters");
    Route::get("policies", function() {return view("parents-info.policies");}); 
    Route::get("uniform", function() {return view("parents-info.uniform");}); 
    Route::get("canteen", function() {return view("parents-info.canteen");});    
});

// Under the 'About Us' dropdown
Route::group(["prefix" => "about"], function() {
    Route::get("principal", function() {return view("about.principal");});
    Route::get("policies", function() {return view("about.policies");});
    Route::get("history", function() {return view("about.history");});    
});

// Under the 'Get Involved' dropdown
Route::group(["prefix" => "involve"], function() {
    Route::get("kids", function() {return view("involve.kids");});
    Route::get("parents", function() {return view("involve.parents");});
    Route::get("teachers", function() {return view("involve.teachers");});
    Route::get("enrolment", function() {return view("involve.enrolment");});
});

Route::group(["as" => "admin.", "prefix" => "admin", "middleware" => "auth"], function() {

    /* =================================================
        Custom resource controller methods
        Must be declared before resource() declaration
    ==================================================*/

    // custom routes for events for batch upload
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

    // custom controller method - put before resource!
    Route::post("admin/links/toggle", [
        "as" => "links.toggle",
        "uses" => "LinkController@toggle"
    ]);

    // custom route for previewing a page
    Route::get("pages/preview", [
        "as" => "pages.preview",
        "middleware" => "ajax",
        "uses" => "PageController@preview"
    ]);

    // custom method for retrieving a templates section
    Route::get("templates/sections", [
        "as" => "templates.sections",
        "middleware" => "ajax",
        "uses" => "TemplateController@getSections"
    ]);    


    /* ==============================================
        Resource controllers
    ===============================================*/
    Route::resource("assets", "AssetController");
    Route::resource("carousel", "CarouselController");
    Route::resource("events", "EventController");
    Route::resource("links", "LinkController");
    Route::resource("pages", "PageController");
    Route::resource("newsletter", "NewsletterController");
    Route::resource("templates", "TemplateController");
});

// Dynamic routing to custom pages
Route::get("/{page_name}", "Controller@dynamic")->name("dynamic.show");