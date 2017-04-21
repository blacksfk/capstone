<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $fillable = ["name"];

    public function galleryimage()
    {
        return $this->hasMany("App\GalleryImage");
    }
}
