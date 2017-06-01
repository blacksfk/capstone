<?php

use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("carousel_items")->insert([
            "id" => 1,
            "asset_id" => 11,
            "caption" => "Responsibility"
        ]);

        DB::table("carousel_items")->insert([
            "id" => 2,
            "asset_id" => 13,
            "caption" => "Resilience"
        ]);

        DB::table("carousel_items")->insert([
            "id" => 3,
            "asset_id" => 14,
            "caption" => "Honesty"
        ]);

        DB::table("carousel_items")->insert([
            "id" => 4,
            "asset_id" => 9,
            "caption" => "Respect"
        ]);
    }
}
