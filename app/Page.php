<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ["name", "active", "link_id", "content"];

    public function link()
    {
        return $this->belongsTo("App\Link");
    }

    protected $casts = [
        "active" => "boolean"
    ];
}
