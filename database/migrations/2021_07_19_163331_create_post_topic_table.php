<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_topic', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("post_id");
            $table->unsignedInteger("topic_id");
            $table->timestamp("created_at")->useCurrent();;

            $table->foreign("post_id")
               ->references("id")
               ->on("posts")
               ->onDelete("cascade");

               $table->foreign("topic_id")
               ->references("id")
               ->on("topics")
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
        Schema::dropIfExists('post_topic');
    }
}
