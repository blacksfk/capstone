<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ["name", "active", "parent_id"];
    protected $casts = ["active" => "boolean"];

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
     * Active attribute mutator
     * @param Boolean $value
     */
    public function setActiveAttribute($value)
    {
        $this->attributes["active"] = $value;
        $this->save();
    }

    /**
     * Toggles the link only if it is bound, or has active children
     * @param  Boolean $value
     * @return Boolean
     */
    public function toggle($value)
    {
        if ($value === false ||
            isset($this->page) || 
            count($this->children->where("active", true)))
        {
            $this->active = $value;
            return true;
        }

        return false;
    }
}
