<?php

namespace App\Http\Controllers;

use App\Utility;
use App\Page;
use App\Template;
use Illuminate\Http\Request;
use App\Http\Requests\TemplatePost;

class TemplateController extends Controller
{

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
    public function store(TemplatePost $request)
    {

        // try to write the file first
        try
        {
            Utility::createFile($request->name, $request->content, "templates");
        }
        catch (\Exception $e)   // Escape to global namespace with reverse slash
        {
            return back()->withInput()->with("errors", "Unable to create file: " . $e->getMessage());
        }

        // save only if writing was successful
        $template = new Template();
        $template->name = $request->name;
        $template->content = $request->content;
        $template->sections = $this->extract($request->content);
        $template->save();

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
    public function update(TemplatePost $request, $id)
    {
        /* repeated validation until i figure if it's worth 
            creating request based validation */
        $template = Template::findOrFail($id);
        
        // now attempt to write to file and handle any exceptions
        try
        {
            Utility::createFile($template->name, $request->content, "templates");
        }
        catch (\Exception $e)
        {
            return back()->withInput()->with("errors", "Unable to write file: " . $e->getMessage());
        }

        // only update the record if file writing was successful
        $template->name = $request->name;
        $template->content = $request->content;
        $template->sections = $this->extract($request->content);

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

        if (!is_null($template->pages))
        {
            return redirect()->route("admin.pages.index")
                ->with("errors", $template->name . " is used by " . count($template->pages) . " page(s) and cannot be deleted";
        }

        try
        {
            Utility::delete(resource_path("views/templates/" . $template->name . ".blade.php"));
        }
        catch (\Exception $e)
        {
            return back()
                ->with("errors", "Unable to delete " . $template->name . " from disk")
                ->with("upadte", $update);
        }

        // now delete the template
        $template->delete();

        return redirect()->route("admin.templates.index")
            ->with("success", "Template deleted successfully");
    }

    /**
     * AJAX only method to retrieve all the sections for page editing
     * @param  Request $request HTTP Request
     * @return JSON
     */
    public function getSections(Request $request)
    {
        $template = Template::find($request->id);

        return json_encode($template->sections);
    }

    /**
     * Extracts and returns the name of each yield in the template
     * @param  string $contents
     * @return array
     */
    private function extract($contents)
    {
        preg_match_all(
            '/@yield\(\'(?<section>.*)\'\)/',
            $contents,
            $matches
        );

        return $matches["section"];
    }
}
