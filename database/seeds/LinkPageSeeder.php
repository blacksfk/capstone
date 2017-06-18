<?php

use App\Link;
use App\Page;
use Illuminate\Database\Seeder;

class LinkPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**###########################################################
         * ###########    README BEFORE MODIFYING    #################
         * ###########################################################
         * 
         * This seeder assumes that the page name is the lowercase
         * of the link name if this is not the case, then insert it
         * manually instead. 
         * 
         * If the link contains a space then it is assumed that the 
         * page filename is: page-name.blade.php. I.e. the space is 
         * replaced by a hyphen
         * 
         * ###########################################################
         * ###########    README BEFORE MODIFYING    #################
         * #########################################################*/

        /**
         * Standard links have numerical keys, dropdowns have the name of the
         * dropdown as the key and their children as the value as an array
         */
        $order = [
            0 => "Home",
            "About us" => ["Principal"],
            "Curriculum" => ["Disabilities", "LOTE", "Sports", "Arts", "Digital Tech", "Literacy", "Numeracy"],
            3 => "Enrolment",
            "Parents Info" => ["Canteen", "Newsletters", "Policies"],
            5 => "Events",
            6 => "Contact"
        ];

        foreach ($order as $key => $val)
        {
            if (is_array($val))
            {
                $category = new Link();

                $category->name = $key;
                $category->active = true;
                $category->parent_id = "";

                $category->save();

                foreach ($val as $child)
                {
                    $link = new Link();
                    $page = new Page();

                    $link->name = $child;
                    $link->active = true;
                    $link->parent_id = $category->id;
                    $link->save();

                    $page->name = str_replace(" ", "-", strtolower($child));
                    $page->link_id = $link->id;
                    $page->save();
                }
            }
            else
            {
                $link = new Link();
                $page = new Page();

                $link->name = $val;
                $link->active = true;
                $link->parent_id = "";
                $link->save();

                $page->name = str_replace(" ", "-", strtolower($val));
                $page->link_id = $link->id;
                $page->save();
            }
        }
    }
}
