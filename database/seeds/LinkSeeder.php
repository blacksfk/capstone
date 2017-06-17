<?php

use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("links")->insert([
            "id" => 1,
            "name" => "Home",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 2,
            "name" => "About us",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 3,
            "name" => "Principal",
            "active" => true,
            "parent_id" => 2
        ]);

        DB::table("links")->insert([
            "id" => 5,
            "name" => "Curriculum",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 6,
            "name" => "Digital Tech",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 8,
            "name" => "Literacy",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 9,
            "name" => "Numeracy",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 10,
            "name" => "LOTE",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 11,
            "name" => "Arts",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 12,
            "name" => "Sports",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 13,
            "name" => "Disabilities",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 15,
            "name" => "Enrolment",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 16,
            "name" => "Parents Info",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 17,
            "name" => "Newsletters",
            "active" => true,
            "parent_id" => 16
        ]);

        DB::table("links")->insert([
            "id" => 18,
            "name" => "Policies",
            "active" => true,
            "parent_id" => 16
        ]);

        DB::table("links")->insert([
            "id" => 20,
            "name" => "Canteen",
            "active" => true,
            "parent_id" => 16
        ]);

        DB::table("links")->insert([
            "id" => 21,
            "name" => "Events",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 22,
            "name" => "Contact",
            "active" => true,
            "parent_id" => ""
        ]);

        // testing only
        /*factory(App\Link::class, 5)->create()->each(function($link) {
            $faker = Faker\Factory::create();
            $page = new App\Page();

            $page->name = $faker->state;
            $page->link_id = $link->id;

            $content = "@extends('layouts.master')\n";
            $content .= "@section('title', '" . $page->name . "')\n";
            $content .= "@section('content')\n";
            $content .=  $faker->realText() . "\n";
            $content .= "@endsection\n";

            App\Utility::createFile($page->name, $content, resource_path("views/"));

            $link->page()->save($page);
        });*/
    }
}
