<?php

use Illuminate\Database\Seeder;

class Template2Seeder extends Seeder
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
        
        DB::table("templates")->insert([
            "id" => 2,
            "name" => "imageoncontent", 
            "content" => 
                "@extends('layouts.master')
                @section('content')
                <div id='features-sec' class='container set-pad'>
                    <div class='row text-center'>
                        <img src='@yield('image')'>
                    </div>
                    <div class='row text-center'>
                        <div class='col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2'>
                            <p>@yield('page_content')</p>
                        </div>
                    </div>
                </div>
                @endsection",
            "sections" => '["page_content"]'
        ]);
        
        DB::table("templates")->insert([
            "id" => 3,
            "name" => "sidebyside", 
            "content" => 
                "@extends('layouts.master')
                @section('content')
                <div id='features-sec' class='container set-pad'>
                    <div class='row text-center'>
                        <div class='col-lg-4 col-lg-offset-2 col-md-4 col-sm-4 col-md-offset-2 col-sm-offset-2'>
                            <p>@yield('page_content')</p>
                        </div>
                        <div class='col-lg-4 col-lg-offset-2 col-md-4 col-sm-4 col-md-offset-2 col-sm-offset-2'>
                            <img src='@yield('image')'>
                        </div>
                    </div>
                </div>
                @endsection",
            "sections" => '["page_content"]'
        ]);
        
        DB::table("templates")->insert([
            "id" => 4,
            "name" => "video", 
            "content" => 
                "@extends('layouts.master')
                @section('content')
                <div id='features-sec' class='container set-pad'>
                    <div class='row text-center'>
                        <div class='col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2'>
                            <video width='500' controls>
                                <source src='@yield('video')'>
                            Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
                @endsection",
            "sections" => '["page_content"]'
        ]);
        
        DB::table("templates")->insert([
            "id" => 4,
            "name" => "video", 
            "content" => 
                "@extends('layouts.master')
                @section('content')
                <div id='features-sec' class='container set-pad'>
                    <div class='row text-center'>
                        <div class='col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2'>
                            <video width='500' controls>
                                <source src='@yield('video')'>
                            Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
                @endsection",
            "sections" => '["page_content"]'
    }
}
