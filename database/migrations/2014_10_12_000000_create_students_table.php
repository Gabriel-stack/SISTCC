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
            $table->string('email')->unique(); // E-mail
            $table->string('registration'); // Matrícula
            $table->string('password'); // Senha
            $table->string('phone'); // Telefone //
            $table->string('state'); // Estado
            $table->string('city'); // Cidade
            $table->string('district'); // Bairro
            $table->string('street'); // Rua
            $table->string('zip_code'); // CEP
            $table->string('historic')->nullable(); // Histórico
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
