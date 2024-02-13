<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

      // Relación con el profesional
      public function profesional()
      {
          return $this->belongsTo(User::class, 'professional_id');
      }
  
      // Relación con el paciente
      public function paciente()
      {
          return $this->belongsTo(User::class, 'patient_id');
      }

      public function notificaciones()
    {
        return $this->hasMany(Notification::class, 'history_id');
    }
}
