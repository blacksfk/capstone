<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests;

class PageController extends Controller
{
	public function index()
	{
		$pages = Page::all();

        return view("admin.gallery.index")->with("images", $images);
	}
	
	public function create()
	{
		return view("admin.gallery.create");
	}
	
	public function store(Request $request)
	{
		$this->validate($request, [
            "name" => "required",
            "category" => "required",
			"path" => "required"
        ]);

        Event::create($request->all());

        return redirect()->route("admin.gallery.index")->with("success", "Image(s) created successfully");
	}
	
	public function edit($id)
	{
		$event = Event::find($id);

        return view("admin.gallery.edit")->with("image", $image);
	}
	
	public function update(Request $request, $id)
	{
		$this->validate($request, [
            "name" => "required",
            "category" => "required",
			"path" => "required"
        ]);

        $image = Page::find($id)->update($request->all());

        // TODO: update the physical file with the new content (rewrite the file)
        // Utilities::writeToFile($request->content());

        return view("admin.gallery.index")->with("success", "Image updated successfully");
	}
	
	public function destroy($id)
	{
		Event::find($id)->delete();

        return redirect()->route("admin.gallery.index")->with("success", "Image deleted successfully");
	}
}

?>