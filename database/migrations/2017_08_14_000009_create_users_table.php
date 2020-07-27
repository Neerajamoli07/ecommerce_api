<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use phpDocumentor\Reflection\Types\Nullable;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_table = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_table, function (Blueprint $table) {            
            $table->increments('id');
            $table->string('name');
            $table->string('avatar', 32)->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable()->default(null);
            $table->string('password', 60);
            $table->tinyInteger('is_activated')->nullable()->default(null);
            $table->rememberToken();
            $table->string('api_token');
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
        Schema::dropIfExists($this->set_table);
    }
}
