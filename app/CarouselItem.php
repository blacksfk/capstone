<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $fillable = ["name", "caption"];
    //
    public function asset()
    {
        return $this->hasOne("App\Asset");
    }
}
