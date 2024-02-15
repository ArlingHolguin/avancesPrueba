<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Location;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 10 usuarios

        $faker = Faker::create();
         // Crear un usuario administrador
         $identificacion = $faker->unique()->numerify('########');
         $admin = User::factory()->create([
            'identification' => $identificacion,
            'name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'phone' => $faker->phoneNumber(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
            'is_first_login' => false,
        ]);
        $admin->assignRole('admin');
        Location::factory()->create(['user_id' => $admin->id]);

         // Crear un usuario profesional
         $identificacion = $faker->unique()->numerify('########');
         $profesional = User::factory()->create([
            'identification' => $identificacion,
            'name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'email' => 'profesional@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'phone' => $faker->phoneNumber(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
            'is_first_login' => false,
        ]);
        $profesional->assignRole('profesional');
        Location::factory()->create(['user_id' => $profesional->id]);

        // Crear un usuario profesional
        $identificacion = $faker->unique()->numerify('########');
        $patient = User::factory()->create([
           'identification' => $identificacion,
           'name' => $faker->firstName(),
           'last_name' => $faker->lastName(),
           'email' => 'paciente@mail.com',
           'email_verified_at' => now(),
           'password' => bcrypt('password'),
           'phone' => $faker->phoneNumber(),
           'two_factor_secret' => null,
           'two_factor_recovery_codes' => null,
           'remember_token' => Str::random(10),
           'profile_photo_path' => null,
           'current_team_id' => null,
            'is_first_login' => false,
       ]);
       $patient->assignRole('patient');
       Location::factory()->create(['user_id' => $patient->id]);

        // Crear 2 usuarios profesionales
        User::factory()->count(2)->create()->each(function ($user) {
            $user->assignRole('profesional');
            Location::factory()->create(['user_id' => $user->id]);
        });

        // Crear el resto como pacientes
        User::factory()->count(100)->create()->each(function ($user) {
            $user->assignRole('patient');
            Location::factory()->create(['user_id' => $user->id]);
        });
    }
}
