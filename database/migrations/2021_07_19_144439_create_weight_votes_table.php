<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_votes', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("post_id");
            $table->unsignedInteger("user_id");
            $table->integer("weight");
            $table->timestamp("voted_on")->useCurrent();;
            $table->foreign("post_id")
              ->references("id")
              ->on("posts")
              ->onDelete("cascade");

            $table->foreign("user_id")
              ->references("id")
              ->on("blog_users")
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
        Schema::dropIfExists('weight_votes');
    }
}
