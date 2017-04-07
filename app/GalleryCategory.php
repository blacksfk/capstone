<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $fillable = ["name", "parent_id"];

    public function galleryimage()
    {
        return $this->hasMany("App\GalleryImage");
    }

    public function parent()
    {
        return $this->belongsTo("App\GalleryCategory", "parent_id", "id");
    }
}
