<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ["name", "link_id", "template_id", "content"];
    protected $casts = ["content" => "array"];

    /**
     * One to one relationship between a link and a page
     * @return Link object The Link object that this page is bound to
     */
    public function link()
    {
        return $this->belongsTo("App\Link");
    }

    /**
     * One to many relationship between templates and pages
     * @return Template The template object that this page uses
     */
    public function template()
    {
        return $this->belongsTo("App\Template");
    }
}
