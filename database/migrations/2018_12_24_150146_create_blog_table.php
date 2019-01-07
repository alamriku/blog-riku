<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('blog_id');
            $table->integer('category_id');
            $table->string('blog_title');
            $table->text('blog_short_description');
            $table->text('blog_long_description');
            $table->string('blog_image');
            $table->string('author_name');
            $table->tinyInteger('publication_status');
            $table->tinyInteger('hit_counter');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
        });
    }
}
