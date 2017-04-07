<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        "name", "category", "path"
    ];
	
	public function gallerycategory()
	{
		return $this->belongsTo("App\GalleryCategory");
	}
}
