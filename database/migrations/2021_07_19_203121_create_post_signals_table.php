<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_signals', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("post_id");
            $table->timestamp("created_at")->useCurrent();;

            $table->foreign("user_id")
               ->references("id")
               ->on("blog_users")
               ->onDelete("cascade");

            $table->foreign("post_id")
               ->references("id")
               ->on("posts")
               ->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_signals');
    }
}
