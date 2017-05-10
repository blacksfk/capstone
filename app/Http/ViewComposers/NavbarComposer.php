<?php

namespace App\Http\ViewComposers;

use App\Link;
use App\ParentLink;
use Illuminate\View\View;

class NavbarComposer
{
    private $links = [];

    /**
     * Get all links in the database and sort them based on
     * whether they are categories or standard links
     */
    public function __construct()
    {
        // get all links that don't have children
        $categories = Link::where("parent_id", "")
                            ->where("active", true)
                            ->get();

        // loop all of the parent links and create objects
        foreach ($categories as $category)
        {
            $this->links[] = new ParentLink($category);
        }
    }

    /**
     * Bind the links to the view
     * @param  View   $view The view to be rendered
     * @return void  
     */
    public function compose(View $view)
    {
        $view->with("dynLinks", $this->links);
    }
}