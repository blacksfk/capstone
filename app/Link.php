<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ["name", "active", "parent"];

    public function page()
    {
        return $this->hasOne("App\Page");
    }

    protected $casts = [
        "active" => "boolean"
    ];
}
