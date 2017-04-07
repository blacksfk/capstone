<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests;

class GalleryImageController extends Controller
{
	public function index()
	{
        return view("admin.gallery.index")->with("images", GalleryImage::all());
	}
	
	public function create()
	{
		$categories = GalleryCategory::all();
		
		if (count($categories) === 0)
		{
			return redirect()->route("admin.GalleryCategory.create")->with("errors", "No categories exist, please create one here first");
		}
		
		return view("admin.gallery.create");
	}
	
	public function store(Request $request)
	{
		$this->validate($request, [
            "name" => "required",
            "category_id" => "required",
			"path" => "required"
        ]);

        GalleryImage::create($request->all());

        return redirect()->route("admin.gallery.index")->with("success", "Image(s) created successfully");
	}
	
	public function destroy($id)
	{
		GalleryImage::findOrFail($id)->delete();

        return redirect()->route("admin.gallery.index")->with("success", "Gallery updated successfully");
	}
}

?>