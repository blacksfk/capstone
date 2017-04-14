<?php

namespace App\Http\Controllers;

use App\Page;
use App\Template;
use Illuminate\Http\Request;
use App\Http\Requests;

class TemplateController extends Controller
{
    private static $validation = [
        "name" => "required|max:255|unique:templates",
        "content" => "required|max:3000"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.templates.index")->with("templates", Template::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.templates.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, self::$validation);

        // try to write the file first
        try
        {
            Utility::save($request->name, $request->content, "templates");
        }
        catch (\Exception $e)   // Escape to global namespace with reverse slash
        {
            return back()->withInput()->with("errors", "Unable to create file: " . $e->getMessage());
        }

        // save only if writing was successful
        Template::create($request->all());

        return redirect()->route("admin.templates.index")->with("success", "Template created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::findOrFail($id);

        return view("admin.templates.edit")->with("template", $template);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, self::$validation);
        $template = Template::findOrFail($id);
        
        // now attempt to write to file and handle any exceptions
        try
        {
            Utility::write($template->name, $template->content, "templates");
        }
        catch (\Exception $e)
        {
            return back()->withInput()->with("errors", "Unable to write file: " . $e->getMessage());
        }

        // only update the record if file writing was successful
        $template->update($request->all());

        return redirect()->route("admin.templates.index")->with("success", $request->name . " updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* get the default template and replace any page
        that uses the template to be deleted with the default */
        $template = Template::findOrFail($id);
        $default = Template::where("name", "default")->first();

        foreach ($template->pages as $page)
        {
            $page->template_id = $default->id;
            $page->save();
        }

        // now delete the template
        $template->delete();

        return redirect()->route("admin.templates.index")->with("success", "Template deleted successfully");

    }
}
