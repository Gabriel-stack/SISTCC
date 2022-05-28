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
            $table->string('name'); // Nome
            $table->string('email'); // E-mail
            $table->string('password'); // Senha
            $table->string('phone'); // Telefone
            $table->text('missing_subjects')->nullable(); // Disciplinas pendentes
            $table->string('semester_origin'); // Semestre de origem
            $table->integer('attended_count_tcc'); // Quantas vezes cursou TCC
            $table->string('state'); // Estado
            $table->string('city'); // Cidade
            $table->string('district'); // Bairro
            $table->string('street'); // Rua
            $table->string('zip_code'); // CEP
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
