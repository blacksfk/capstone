<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->integer("link_id")->unsigned();
            $table->string("content");
            $table->timestamps();
        });

        Schema::table("pages", function(Blueprint $table) {
            $table->foreign("link_id")->references("id")->on("links");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
