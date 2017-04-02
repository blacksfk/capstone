<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->tinyInteger("status");
            $table->integer("parent")->unsigned()->nullable();
        });

        Schema::table("links", function(Blueprint $table) {
            // self reference for drop downs
            $table->foreign("parent")->references("id")->on("links");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('links');
    }
}
