<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->unsignedBigInteger('author_id');
            $table->string('post_name');
            $table->text('content');
            $table->string('img_url')->nullable();
            $table->unsignedBigInteger('categ_id')->nullable();
            $table->timestamps();

            $table->index('categ_id', 'post_category_idx');
            $table->index('author_id', 'post_user_idx');

            $table->foreign('categ_id', 'post_category_fk')->on('categories')->references('category_id');
            $table->foreign('author_id', 'post_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
