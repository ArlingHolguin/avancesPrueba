<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    // Relación para historias clínicas donde el usuario es el profesional
    public function historiasComoProfesional()
    {
        return $this->hasMany(History::class, 'professional_id');
    }

    // Relación para historias clínicas donde el usuario es el paciente
    public function historiasComoPaciente()
    {
        return $this->hasMany(History::class, 'patient_id');
    }


    public function location()
    {
        return $this->hasOne(Location::class);
    }


    public function notificacionesComoProfesional()
    {
        return $this->hasMany(Notification::class, 'professional_id');
    }

    public function notificacionesComoPaciente()
    {
        return $this->hasMany(Notification::class, 'patient_id');
    }

    
}
