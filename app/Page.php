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
     * Extracts HTML from the string if blade is present. Returns the 
     * match if blade is present, otherwise returns the input string.
     * 
     * @param  string $string
     * @return string         String of HTML
     */
    public static function extractHTML($string)
    {
        $match = preg_match("/\@section\('\w+'\)(?P<content>[\s\S]*)\@endsection/", $string, $matches);

        if ($match)
        {
            return $matches["content"];
        }

        return $string;
    }

    /**
     * Adds necessary blade directives to the file to be written
     * 
     * @param  string $name
     * @param  string $html
     * @return string
     */
    public static function insertBladeDirectives($name, $html)
    {
        $content = "@extends('layouts.master')\n";
        $content .= "@section('title', '" . $name . "')\n";
        $content .= "@section('content')\n";
        $content .= $html . "\n";
        $content .= "@endsection\n";

        return $content;
    }
}
