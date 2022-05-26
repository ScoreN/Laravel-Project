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
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('comm_id');
            $table->unsignedBigInteger('comm_user_id');
            $table->unsignedBigInteger('comm_post_id');
            $table->text('comm_text');
            $table->timestamps();

            $table->index('comm_user_id', 'comment_user_idx');
            $table->index('comm_post_id', 'comment_post_idx');

            $table->foreign('comm_user_id', 'comment_user_fk')->on('users')->references('id');
            $table->foreign('comm_post_id', 'comment_post_fk')->on('posts')->references('post_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
