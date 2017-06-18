<?php

use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("assets")->insert([
            "id" => 1,
            "name" => "Web pics 052.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 2,
            "name" => "edumail_screen.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 3,
            "name" => "CGPS_location.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 4,
            "name" => "principal.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 5,
            "name" => "multimedia_pic1.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 6,
            "name" => "primary_crop.png",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 7,
            "name" => "multimedia_pic2.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 8,
            "name" => "CGPS rainbow.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 9,
            "name" => "CGPS_9.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 10,
            "name" => "contact.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 11,
            "name" => "CGPS_26.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 12,
            "name" => "primary_logo.png",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 13,
            "name" => "CGPS_002.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 14,
            "name" => "CGPS_19.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 15,
            "name" => "CGPS_maps.png",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 16,
            "name" => "IMG_3378.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 17,
            "name" => "digilearn_screen.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 18,
            "name" => "epotential_screen.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 19,
            "name" => "kids_group.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 20,
            "name" => "writing_fun_screen.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 21,
            "name" => "priority_zones.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 22,
            "name" => "CGPS_18.jpg",
            "type" => "img"
        ]);

        DB::table("assets")->insert([
            "id" => 23,
            "name" => "CGPS_20.jpg",
            "type" => "img"
        ]);
    }
}
