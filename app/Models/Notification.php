<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'history_id');
    }
}
