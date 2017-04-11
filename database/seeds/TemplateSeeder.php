<?php

use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("templates")->insert([
            "id" => 1,
            "name" => "default", 
            "content" => 
                "@extends('layouts.master')" .
                "@section('content')" .
                "@yield('page_content')" .
                "@endsection"
        ]);
    }
}
