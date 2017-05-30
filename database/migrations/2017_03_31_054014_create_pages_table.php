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
            $table->string("content");
            $table->integer("link_id")->unsigned()->nullable();
            $table->integer("template_id")->unsigned()->nullable();
            $table->timestamps();

            $table->foreign("link_id")->references("id")->on("links");
            $table->foreign("template_id")->references("id")->on("templates");
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
