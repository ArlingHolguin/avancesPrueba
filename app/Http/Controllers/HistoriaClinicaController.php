<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get de todas las notificaciones del usuario logueado
        $notifications = auth()->user()->notifications;

        // returnar a la vista de notificaciones
        return Inertia::render('Notifications', [
            'notifications' => $notifications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //usuarios con el rol de paciente
        $patients = User::role('patient')->get();
        $profesionalLogin = auth()->user();

        //crear una nueva historia clinica
        return Inertia::render('CreateHistoriaClinica', [
            'patients' => $patients,
            'profesionalLogin' => $profesionalLogin
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
          // Validar la solicitud (Request)
          $validatedData = $request->validate([
            // Aquí tus reglas de validación...
        ]);

        // Crear la historia clínica
        $historiaClinica = HistoriaClinica::create($validatedData);

        // Disparar el evento
        event(new HistoriaClinicaCreada($historiaClinica));

        // Retornar respuesta, por ejemplo, un redirect o un JSON
        return response()->json([
            'message' => 'Historia clínica creada con éxito',
            'historiaClinica' => $historiaClinica
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //mostrar la historia clinica con el id que se pasa por parametro
        $historiaClinica = HistoriaClinica::find($id);

        //retornar la vista de la historia clinica
        return Inertia::render('HistoriaClinica', [
            'historiaClinica' => $historiaClinica
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //editar la historia clinica con el id que se pasa por parametro
        $historiaClinica = HistoriaClinica::find($id);

        //retornar la vista de la historia clinica
        return Inertia::render('HistoriaClinica', [
            'historiaClinica' => $historiaClinica
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //editar la historia clinica con el id que se pasa por parametro
        $historiaClinica = HistoriaClinica::find($id);

        // Validar la solicitud (Request)
        $validatedData = $request->validate([
            // Aquí tus reglas de validación...
        ]);

        // Actualizar la historia clínica
        $historiaClinica->update($validatedData);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
