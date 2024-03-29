<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    // these constants store the directory name in public/assets/
    const TYPE_IMAGE = "img";
    const TYPE_VIDEO = "video";
    const TYPE_PDF = "pdf";
    const TYPE_NEWSLETTER = "newsletters";
    
    // stores all of the types for selection, Asset::TYPES
    const TYPES = [
        self::TYPE_IMAGE => "Image", 
        self::TYPE_VIDEO => "Video", 
        self::TYPE_PDF => "PDF",
        self::TYPE_NEWSLETTER => "Newsletter"
    ];

    // supported formats
    const TYPE_IMAGE_FORMATS = ["image/png", "image/jpeg", "image/bmp", "image/gif"];
    const TYPE_VIDEO_FORMATS = ["video/mp4"];
    const TYPE_PDF_FORMATS = ["application/pdf"];
    
    protected $fillable = ["name", "type"];

    public function carouselItem()
    {
        return $this->hasMany("app\CarouselItem");
    }
}
