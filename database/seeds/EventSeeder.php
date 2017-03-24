<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("events")->insert([
            "id" => 99999,
            "name" => "Term 1 begins",
            "date" => "January 1st",
            "start_time" => "00:01",
            "end_time" => "NEVER",
            "notes" => "You're stuck here forever."
        ]);
    }
}
