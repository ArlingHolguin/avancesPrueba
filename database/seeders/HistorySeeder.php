<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\History;
use App\Models\User;


class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $profesionales = User::role('profesional')->get();
        $pacientes = User::role('patient')->get();

        for ($i = 0; $i < 100; $i++) {
            // Seleccionar aleatoriamente un profesional y un paciente
            $profesional = $profesionales->random();
            $paciente = $pacientes->random();

            // Crear una nueva historia clínica
            History::create([
                'professional_id' => $profesional->id,
                'patient_id' => $paciente->id,
                'fecha_hora' => now(),
                'consecutivo_paciente' => $i, // O alguna lógica específica para este campo
                'estado_paciente' => 'Algun estado',
                'antecedentes' => 'Algunos antecedentes',
                'evolucion_final' => 'Alguna evolución final',
                'concepto_profesional' => 'Algún concepto profesional',
                'recomendaciones' => 'Algunas recomendaciones',
                'firmado_por_paciente' => false,
                'firma_paciente' => null,
                'ruta_firma_paciente' => null,
            ]);
        }
    }
}
