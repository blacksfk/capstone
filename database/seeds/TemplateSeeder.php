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
                "@extends('layouts.master')
                @section('content')
                <div id='features-sec' class='container set-pad'>
                    <div class='row text-center'>
                        <div class='col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2'>
                            <p>@yield('page_content')</p>
                        </div>
                    </div>
                </div>
                @endsection",
            "sections" => '["page_content"]'
        ]);
    }
}
