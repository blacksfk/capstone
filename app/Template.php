<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ["name", "content", "sections"];

    /**
     * One to many relationship between this template and pages that
     * reference it
     * 
     * @return Collection A collection of Page objects
     */
    public function pages()
    {
        return $this->hasMany("App\Page");
    }

    protected $casts = [
        'sections' => 'array',
    ];
}
