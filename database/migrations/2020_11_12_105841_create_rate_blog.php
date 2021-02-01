<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_blog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rate');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('blog_id')->constrained('blog');
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
        Schema::dropIfExists('rate_blog');
    }
}
