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
        Schema::create('tccs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('professor_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade'); // Id do orientador
            $table->bigInteger('coprofessor_id')->nullable(); // Id do co-orientador
            $table->enum('stage', ['Etapa 1',  'Etapa 2', 'Etapa 3'])->default('Etapa 1'); // Etapa do TCC
            $table->enum('situation', ['Cursando', 'Em análise', 'Devolvido', 'Aprovado', 'Reprovado'])->default('Cursando'); // Status do TCC
            $table->string('theme')->nullable(); // Tema
            $table->string('title')->nullable(); // Título
            $table->boolean('ethics_committee')->nullable(); // Comitê de ética
            $table->string('term_commitment')->nullable(); // Termo de compromisso
            $table->datetime('date_claim')->nullable(); // Data de pretenção de defesa
            $table->string('photo')->nullable(); // foto
            $table->string('keywords')->nullable(); // Palavras chave
            $table->text('abstract')->nullable(); // Resumo
            $table->string('type_tcc')->nullable(); // Tipo de TCC
            $table->datetime('intended_date')->nullable(); // Data de defesa pretendida
            $table->string('result_ethic_committee')->nullable(); // Parecer do comitê de ética
            $table->string('proof_article_submission')->nullable(); // Comprovante de submissão de artigo
            $table->string('consent_professor')->nullable(); // Anuência do orientador
            $table->string('file_pretcc')->nullable(); // Pré TCC
            $table->string('file_tcc')->nullable(); // TCC Final
            $table->string('final_tcc')->nullable(); // TCC Final pós banca
            $table->string('deposit_statement')->nullable(); // Declaração de depósito na biblioteca
            $table->json('members')->nullable(); // Membros da banca
            $table->text('message')->nullable(); // Mensagem de devolução de etapa
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
        Schema::dropIfExists('tccs');
    }
};
