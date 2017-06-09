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
            "name" => "Home",
            "link_id" => 1
        ]);

        DB::table("pages")->insert([
            "id" => 2,
            "name" => "Principal",
            "link_id" => 3
        ]);

        DB::table("pages")->insert([
            "id" => 3,
            "name" => "History",
            "link_id" => 4
        ]);

        DB::table("pages")->insert([
            "id" => 4,
            "name" => "Digital tech",
            "link_id" => 6
        ]);

        DB::table("pages")->insert([
            "id" => 5,
            "name" => "eSmart",
            "link_id" => 7
        ]);

        DB::table("pages")->insert([
            "id" => 6,
            "name" => "Literacy",
            "link_id" => 8
        ]);

        DB::table("pages")->insert([
            "id" => 7,
            "name" => "Numeracy",
            "link_id" => 9
        ]);

        DB::table("pages")->insert([
            "id" => 8,
            "name" => "LOTE",
            "link_id" => 10
        ]);

        DB::table("pages")->insert([
            "id" => 9,
            "name" => "Arts",
            "link_id" => 11
        ]);

        DB::table("pages")->insert([
            "id" => 10,
            "name" => "Sports",
            "link_id" => 12
        ]);

        DB::table("pages")->insert([
            "id" => 11,
            "name" => "Disabilities",
            "link_id" => 13
        ]);

        DB::table("pages")->insert([
            "id" => 12,
            "name" => "TMS",
            "link_id" => 14
        ]);

        DB::table("pages")->insert([
            "id" => 13,
            "name" => "Enrolment",
            "link_id" => 15
        ]);

        DB::table("pages")->insert([
            "id" => 14,
            "name" => "Newsletters",
            "link_id" => 17
        ]);

        DB::table("pages")->insert([
            "id" => 15,
            "name" => "Policies",
            "link_id" => 18
        ]);

        DB::table("pages")->insert([
            "id" => 16,
            "name" => "Uniform",
            "link_id" => 19
        ]);

        DB::table("pages")->insert([
            "id" => 17,
            "name" => "Canteen",
            "link_id" => 20
        ]);

        DB::table("pages")->insert([
            "id" => 18,
            "name" => "Events",
            "link_id" => 21
        ]);

        DB::table("pages")->insert([
            "id" => 19,
            "name" => "Contact",
            "link_id" => 22
        ]);
    }
}
