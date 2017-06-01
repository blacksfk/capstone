<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    // these constants store the directory name in public/assets/
    const TYPE_IMAGE = "img";
    const TYPE_VIDEO = "video";
    const TYPE_PDF = "pdf";
    
    // stores all of the types for selection, Asset::TYPES
    const TYPES = [
        self::TYPE_IMAGE => "Image", 
        self::TYPE_VIDEO => "Video", 
        self::TYPE_PDF => "PDF"
    ];

    
    protected $fillable = ["name", "type"];

    public function carouselItem()
    {
        return $this->hasMany("app\CarouselItem");
    }
}
