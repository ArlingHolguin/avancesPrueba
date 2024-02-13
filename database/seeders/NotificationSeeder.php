<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Notification::create([
            'title' => 'Notificación de Prueba',
            'msg' => 'Este es un mensaje de prueba.',
            'history_id' => 1,
            'professional_id' => 2,
            'patient_id' => 3,
            'is_read' => false
        ]);
    }
}
