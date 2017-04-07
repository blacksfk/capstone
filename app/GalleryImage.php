<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        "name", "category_id", "path"
    ];
	
	public function gallerycategory()
	{
		return $this->belongsTo("App\GalleryCategory", "category_id", "id");
	}
}
