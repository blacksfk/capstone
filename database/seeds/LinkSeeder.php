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
            "name" => "index",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 2,
            "name" => "about us",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 3,
            "name" => "principal",
            "active" => true,
            "parent_id" => 2
        ]);

        DB::table("links")->insert([
            "id" => 4,
            "name" => "history",
            "active" => true,
            "parent_id" => 2
        ]);

        DB::table("links")->insert([
            "id" => 5,
            "name" => "curriculum",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 6,
            "name" => "digital tech",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 7,
            "name" => "esmart",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 8,
            "name" => "literacy",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 9,
            "name" => "numeracy",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 10,
            "name" => "lote",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 11,
            "name" => "arts",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 12,
            "name" => "sports",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 13,
            "name" => "disabilities",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 14,
            "name" => "tms",
            "active" => true,
            "parent_id" => 5
        ]);

        DB::table("links")->insert([
            "id" => 15,
            "name" => "enrolment",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 16,
            "name" => "parents info",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 17,
            "name" => "newsletters",
            "active" => true,
            "parent_id" => 16
        ]);

        DB::table("links")->insert([
            "id" => 18,
            "name" => "policies",
            "active" => true,
            "parent_id" => 16
        ]);

        DB::table("links")->insert([
            "id" => 19,
            "name" => "Uniform",
            "active" => true,
            "parent_id" => 16
        ]);

        DB::table("links")->insert([
            "id" => 20,
            "name" => "canteen",
            "active" => true,
            "parent_id" => 16
        ]);

        DB::table("links")->insert([
            "id" => 21,
            "name" => "events",
            "active" => true,
            "parent_id" => ""
        ]);

        DB::table("links")->insert([
            "id" => 22,
            "name" => "contact",
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
