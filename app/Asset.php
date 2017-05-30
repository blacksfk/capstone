<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ["name", "type"];
    public static $assetTypes = ["img" => "Image", "video" => "Video", "pdf" => "PDF"];

    public function carouselItem()
    {
        return $this->hasMany("app\CarouselItem");
    }
}
