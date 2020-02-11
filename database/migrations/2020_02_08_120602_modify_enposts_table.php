<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEnpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enposts', function (Blueprint $table) {
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enposts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->change(); 
        });
    }
}
