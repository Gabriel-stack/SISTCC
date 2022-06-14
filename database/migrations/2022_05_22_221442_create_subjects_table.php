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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('course_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('manager_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('class')->unique();
            $table->string('class_code');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('close_date')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('subjects');
    }
};
