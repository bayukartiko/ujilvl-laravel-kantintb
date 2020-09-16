<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user', 5);
            $table->string('username', 250)->unique();
            $table->string('password', 250);
            $table->string('name', 250);
            $table->integer('id_level')->length(1);
            $table->timestamps();
        });

        // Schema::table('posts', function (Blueprint $table) {
        //     $table->foreign('id_level')->references('id_level')->on('levels');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
