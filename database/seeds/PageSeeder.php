<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("pages")->insert([
            "id" => 1,
            "name" => "home",
            "link_id" => 1
        ]);

        DB::table("pages")->insert([
            "id" => 2,
            "name" => "principal",
            "link_id" => 3
        ]);

        DB::table("pages")->insert([
            "id" => 3,
            "name" => "history",
            "link_id" => 4
        ]);

        DB::table("pages")->insert([
            "id" => 4,
            "name" => "digital-tech",
            "link_id" => 6
        ]);

        DB::table("pages")->insert([
            "id" => 5,
            "name" => "esmart",
            "link_id" => 7
        ]);

        DB::table("pages")->insert([
            "id" => 6,
            "name" => "literacy",
            "link_id" => 8
        ]);

        DB::table("pages")->insert([
            "id" => 7,
            "name" => "numeracy",
            "link_id" => 9
        ]);

        DB::table("pages")->insert([
            "id" => 8,
            "name" => "lote",
            "link_id" => 10
        ]);

        DB::table("pages")->insert([
            "id" => 9,
            "name" => "arts",
            "link_id" => 11
        ]);

        DB::table("pages")->insert([
            "id" => 10,
            "name" => "sports",
            "link_id" => 12
        ]);

        DB::table("pages")->insert([
            "id" => 11,
            "name" => "disabilities",
            "link_id" => 13
        ]);

        DB::table("pages")->insert([
            "id" => 12,
            "name" => "tms",
            "link_id" => 14
        ]);

        DB::table("pages")->insert([
            "id" => 13,
            "name" => "enrolment",
            "link_id" => 15
        ]);

        DB::table("pages")->insert([
            "id" => 14,
            "name" => "newsletters",
            "link_id" => 17
        ]);

        DB::table("pages")->insert([
            "id" => 15,
            "name" => "policies",
            "link_id" => 18
        ]);

        DB::table("pages")->insert([
            "id" => 16,
            "name" => "uniform",
            "link_id" => 19
        ]);

        DB::table("pages")->insert([
            "id" => 17,
            "name" => "canteen",
            "link_id" => 20
        ]);

        DB::table("pages")->insert([
            "id" => 18,
            "name" => "events",
            "link_id" => 21
        ]);

        DB::table("pages")->insert([
            "id" => 19,
            "name" => "contact",
            "link_id" => 22
        ]);
    }
}
