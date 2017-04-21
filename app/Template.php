<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ["name", "content","sections"];

    public function pages()
    {
        return $this->hasMany("App\Page");
    }

    protected $casts = [
        'sections' => 'array',
    ];
}
