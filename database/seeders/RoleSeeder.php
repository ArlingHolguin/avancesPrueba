<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //roles admin, profesional, patient
        $admin = Role::create(['name' => 'admin']);
        $profesional = Role::create(['name' => 'profesional']);
        $patient = Role::create(['name' => 'patient']);

        //permissions
        //ver dashboard 
        Permission::create(['name' => 'view dashboard'])->syncRoles([$admin, $profesional, $patient]);
        

        //configuracion perfil usuario
        Permission::create(['name' => 'edit profile'])->syncRoles([$admin, $profesional, $patient]);
        


        //crear usuarios y roles
        Permission::create(['name' => 'create users'])->syncRoles([$admin]);
        Permission::create(['name' => 'create roles'])->syncRoles([$admin]);
        //editar usuarios y roles
        Permission::create(['name' => 'edit users'])->syncRoles([$admin]);
        Permission::create(['name' => 'edit roles'])->syncRoles([$admin]);
        //eliminar usuarios y roles
        Permission::create(['name' => 'delete users'])->syncRoles([$admin]);
        Permission::create(['name' => 'delete roles'])->syncRoles([$admin]);
        //ver usuarios y roles
        Permission::create(['name' => 'view users'])->syncRoles([$admin]);
        Permission::create(['name' => 'view roles'])->syncRoles([$admin]);

        //permisos para crear historias clinicas solo admin y profesionales
        Permission::create(['name' => 'create clinical histories'])->syncRoles([$admin, $profesional]);
        //permisos para ver historias clinicas solo admin y profesionales y pacientes
        Permission::create(['name' => 'view clinical histories'])->syncRoles([$admin, $profesional, $patient]);
        //permisos para editar historias clinicas solo admin y profesionales
        Permission::create(['name' => 'edit clinical histories'])->syncRoles([$admin, $profesional]);
        
        
        //crear el paciente tiene que marcar como asistida la historia anexando una firma
        Permission::create(['name' => 'create clinical histories asistida'])->syncRoles([$admin, $patient]);
        

        // editar la carga de la firma 
        Permission::create(['name' => 'edit clinical histories asistida'])->syncRoles([$admin, $patient]);
        
        
        //ver la historia clinica asistida
        Permission::create(['name' => 'view clinical histories asistida'])->syncRoles([$admin, $profesional, $patient]);


        



    }
}
