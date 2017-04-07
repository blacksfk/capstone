<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests;

class GalleryCategoryController extends Controller
{
	public function index()
	{
        return view("admin.gallerycategories.index")->with("categories", GalleryCategory::all());
	}
	
	public function create()
	{
		return view("admin.gallerycategories.create");
	}
	
	public function store(Request $request)
	{
		$this->validate($request, [
            "name" => "required"
        ]);

        Event::create($request->all());

        return redirect()->route("admin.gallery.index")->with("success", "Image(s) created successfully");
	}
	
	public function edit($id)
	{
		$event = GalleryCategory::find($id);

        return view("admin.gallerycategory.edit")->with("gallerycategory", GalleryCategory::find($id));
	}
	
	public function update(Request $request, $id)
	{
		$this->validate($request, [
            "name" => "required"
        ]);

        GalleryCategory::find($id)->update($request->all());

        return view("admin.gallery.index")->with("success", "Category updated successfully");
	}
	
	public function destroy($id)
	{
		GalleryCategory::find($id)->delete();
		GalleryImage::where($id, $category_id)->delete();

        return redirect()->route("admin.gallery.index")->with("success", "Category deleted successfully");
	}
}

?>