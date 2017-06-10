<?php

namespace App;

/**
 * Use this class when composing the navbar for an easier time spitting
 * out the relevant information in the navbar.
 */
class ParentLink
{
    private $linkObject;
    private $children;

    public function __construct($link, $is_navbar = true)
    {
        $this->linkObject = $link;

        if ($is_navbar)
        {
            $this->children = $link->children->where("active", true);
        }
        else
        {
            $this->children = $link->children;
        }
    }

    public function getLink()
    {
        return $this->linkObject;
    }

    public function getChildren()
    {
        return $this->children;
    }
}