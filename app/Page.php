<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ["name", "link_id", "content"];

    public function link()
    {
        return $this->belongsTo("App\Link");
    }
}
