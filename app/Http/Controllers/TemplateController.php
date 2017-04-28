<?php

namespace App\Http\Controllers;

use App\Utility;
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

        $sections = $this->extract($request->content);
        //dd(gettype($sections));

        // save only if writing was successful
        Template::create(['name' => $request->name,'content'=>$request->content,'sections'=>$sections]);

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
        /* repeated validation until i figure if it's worth 
            creating request based validation */
        $this->validate($request, [
            "name" => "required|max:255",
            "content" => "required|max:3000"
        ]);
        $template = Template::findOrFail($id);
        
        // now attempt to write to file and handle any exceptions
        try
        {
            Utility::save($template->name, $request->content, "templates");
        }
        catch (\Exception $e)
        {
            return back()->withInput()->with("errors", "Unable to write file: " . $e->getMessage());
        }

        $sections = $this->extract($request->content);

        // only update the record if file writing was successful
        $template->update(['name' => $request->name,'content'=>$request->content,'sections'=>$sections]);

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
        $update = [];

        foreach ($template->pages as $page)
        {
            $page->template_id = $default->id;
            $page->save();
            $update[] = $page->name . " was updated with the default template";
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
            ->with("success", "Template deleted successfully")
            ->with("update", $update);
    }

    // Ajax only method to retrieve all the sections for page editing
    public function getSections(Request $request)
    {
        $template = Template::find($request->id);

        return json_encode($template->sections);
    }

    private function extract($contents)
    {
        preg_match_all(
            '/@yield\(\'(?<section>.*)\'\)/',
            $contents,
            $matches);
        return $matches["section"];
    }
}
