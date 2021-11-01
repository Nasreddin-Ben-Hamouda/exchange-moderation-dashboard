<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_signals', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("comment_id");
            $table->unsignedInteger("user_id");

            $table->foreign("comment_id")
            ->references("id")->on("comments")
            ->onDelete("cascade");

            $table->foreign("user_id")
            ->references("id")->on("blog_users")
            ->onDelete("cascade");

            $table->timestamp("created_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_signals');
    }
}
