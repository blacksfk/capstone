<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $fillable = ["asset_id", "caption"];

    public function asset()
    {
        return $this->belongsTo("App\Asset");
    }
}
