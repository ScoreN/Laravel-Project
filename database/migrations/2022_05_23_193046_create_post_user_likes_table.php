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
        Schema::create('post_user_likes', function (Blueprint $table) {
            $table->Id();
            $table->unsignedBigInteger('like_post_id');
            $table->unsignedBigInteger('like_user_id');
            $table->timestamps();

            $table->index('like_post_id', 'pul_post_idx');
            $table->index('like_user_id', 'pul_user_idx');

            $table->foreign('like_post_id', 'pul_post_fk')->on('posts')->references('post_id');
            $table->foreign('like_user_id', 'pul_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_user_likes');
    }
};
