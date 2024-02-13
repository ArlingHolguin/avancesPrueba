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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->constrained('users');
            $table->foreignId('patient_id')->constrained('users');
            
            $table->timestamp('fecha_hora');
            $table->integer('consecutivo_paciente');
            $table->text('estado_paciente');
            $table->text('antecedentes')->nullable();
            $table->text('evolucion_final')->nullable();
            $table->text('concepto_profesional')->nullable();
            $table->text('recomendaciones')->nullable();

            $table->binary('firma_paciente')->nullable();
            $table->string('ruta_firma_paciente')->nullable(); // Para almacenar la ruta de la imagen de la firma
            $table->boolean('firmado_por_paciente')->default(false); 
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
        Schema::dropIfExists('histories');
    }
};
