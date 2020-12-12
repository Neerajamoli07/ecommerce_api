<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place_name', 255)->nullable();
            $table->string('pin_code', 255)->nullable();
            $table->string('distance', 255)->nullable();
            $table->string('deliver_cost', 255)->nullable();
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
        Schema::dropIfExists('postals');
    }
}
