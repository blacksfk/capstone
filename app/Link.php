<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ["name", "active", "parent_id"];

    /**
     * One to One relationship between this link and it's page
     * @return Page An object of type Page
     */
    public function page()
    {
        return $this->hasOne("App\Page");
    }

    /**
     * One to Many relationship between links (self-reference)
     * @return array An array of Link objects
     */
    public function children()
    {
        return $this->hasMany("App\Link", "parent_id", "id");
    }

    /**
     * Many to One relationship between links (self-reference)
     * @return Link A Link object
     */
    public function parent()
    {
        return $this->belongsTo("App\Link", "parent_id", "id");
    }

    /**
     * Casts the active attribute from tinyInt to boolean so you
     * can run checks like: if ($link->active) { // } etc.
     * @var Boolean
     */
    protected $casts = [
        "active" => "boolean"
    ];
}
