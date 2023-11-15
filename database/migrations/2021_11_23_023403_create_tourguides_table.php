<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourguidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourguides', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('dob');
            $table->integer('gender');
            $table->string('email');
            $table->string('phone');
            $table->string('short_description');
            $table->longtext('description');
            $table->integer('rental_price');
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
        Schema::dropIfExists('tourguides');
    }
}
