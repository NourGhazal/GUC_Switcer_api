<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFifthyearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fifthyear', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') ->references('id')->on('users')->onDelete('cascade');
            $table->string('token');
            $table->integer('major');
            $table->integer('from');
            $table->integer('to');
            $table->string('extra_courses');
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
        Schema::dropIfExists('fifthyear');
    }
}
