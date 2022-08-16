<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('chName');
            $table->string('motherName');
            $table->string('phoneNumber');
            $table->string('birthDate');
            $table->string('city');
            $table->string('wereda');
            $table->string('kebele');
            $table->string('houseNumber');
            $table->string('sex');
            $table->string('schoolName');
            $table->string('grade');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('section_id');
            $table->string('password')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnDelete();
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
        Schema::dropIfExists('students');
    }
}
