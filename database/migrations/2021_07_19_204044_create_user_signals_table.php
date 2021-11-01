<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_signals', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("signaled_id");
            $table->timestamp("created_at")->useCurrent();
            $table->morphs('context');

            $table->foreign("user_id")
              ->references("id")
              ->on("blog_users")
              ->onDelete("cascade");

              $table->foreign("signaled_id")
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
        Schema::dropIfExists('user_signals');
    }
}
