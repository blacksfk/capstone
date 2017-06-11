<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ["name", "link_id"];

    /**
     * One to one relationship between a link and a page
     * @return Link object The Link object that this page is bound to
     */
    public function link()
    {
        return $this->belongsTo("App\Link");
    }
    
    /**
     * Extracts the HTML from the string
     * @param  string $string
     * @return string         The HTML extracted
     */
    public static function extractHTML($string)
    {
        preg_match("/\@section\('\w+'\)(?P<content>[\s\S]*)\@endsection/", $string, $matches);

        return $matches["content"];
    }
}
