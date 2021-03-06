<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            // $table->string('status');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            // $table->string('phone');
            // $table->string('semester_origin');
            // $table->integer('attended_count_tcc');
            // $table->string('state');
            // $table->string('city');
            // $table->string('district');
            // $table->string('street');
            // $table->string('zipcode');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
};
