<?php

namespace App\Http\ViewComposers;

use App\Link;
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
        $categories = Link::where("parent_id", null)
                            ->where("active", true)
                            ->get();

        // now get all their children
        foreach ($categories as $category)
        {
            $children = Link::where("parent_id", $category->id)
                                ->where("active", true)
                                ->get();

            if (count($children) === 0)
            {
                $this->links[$category->name] = $category;
            }
            else
            {
                $this->links[$category->name] = $children;
            }
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