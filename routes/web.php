<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $roles = Spatie\Permission\Models\Role::all();
    // $permissions = Spatie\Permission\Models\Permission::all();
    // //retornar todos los persmios de admin 
    // $admin = Spatie\Permission\Models\Role::findByName('admin');
    // $adminPermissions = $admin->permissions;

    // // todos los usuarios 
    // // $users = App\Models\User::all();

    // //retornar la data delos usuarios con la data que le corresponde de Location y Role pero solo 
    // //"id": 1,
    //   // "name": "admin", del role 
      
    //   $users = App\Models\User::with([
    //     'location:id,user_id,state,city,address', // Seleccionar campos específicos de location
    //     'roles:id,name' // Seleccionar id y nombre de roles
    // ])->get();

    // //retornar todas las historias asociadas al usuario con id 3
    // $historiesUser = App\Models\History::where('patient_id', 3)->get();

    // $locations = App\Models\Location::all();

    // // todas las notificciones de paciente con id 3
    // $notifications = App\Models\Notification::where('patient_id', 3)->get();




    // //retorar un json con los roles y permisos
    // return response()->json([
    //     'roles' => $roles,
    //     'permissions' => $permissions,
    //     'adminPermissions' => $adminPermissions,
    //     'users' => $users,
    //     'locations' => $locations,
    //     'historiesUser' => $historiesUser,
    //     'notifications_patient_3' => $notifications
        
    // ]);


    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //ruta para crear una  historia clinica
});
