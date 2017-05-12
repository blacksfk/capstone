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

    public function __construct($link)
    {
        $this->linkObject = $link;
        $this->children = $link->children->where("active", true);
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