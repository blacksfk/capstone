<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ["name", "active", "parent_id"];

    public function page()
    {
        return $this->hasOne("App\Page");
    }

    public function parent()
    {
        return $this->belongsTo("App\Link", "parent_id", "id");
    }

    protected $casts = [
        "active" => "boolean"
    ];
}
