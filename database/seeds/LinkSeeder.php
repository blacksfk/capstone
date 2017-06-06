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
        factory(App\Link::class, 5)->create()->each(function($link) {
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
        });
    }
}
