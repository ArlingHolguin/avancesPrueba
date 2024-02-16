<?php

namespace App\Http\Controllers;

use App\Events\HistoriaCreada;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;





class HistoryController extends Controller
{
    //get all histories
    public function index()
    {
        $userLogin = Auth::user()->load([
            'roles:name'
        ]);



       $histories = $userLogin->historiasComoPaciente()->get();
        return Inertia::render('History/index',
        [
            'histories' => $histories
        ]);
    }

    //create a new history
    public function create()
    {

            $userLogin = Auth::user()->load([
                'roles:name'
            ]);



           $histories = $userLogin->historiasComoPaciente()->get();
        //    $histories =[];

            $histories = $userLogin->historiasComoPaciente()->get();
            // dd($histories);



            return Inertia::render('History/Create',
            [
                'userLogin' => $userLogin,
                'histories' => $histories
            ]);


    }

    public function store(Request $request){
        $profesional = Auth::user();
        //consecutivo por paciente debe empezar CP-00 y aumentar en 1 por cada historia
        $consecutivo = History::where('patient_id', $request->patient_id)->count() + 1;

        $history = new History();
        $history->patient_id = $request->patient_id;
        $history->professional_id = $profesional->id;
        $history->consecutivo_paciente = "CP-00" . $consecutivo;
        $history->estado_paciente = $request->estado_paciente;
        $history->antecedentes = $request->antecedentes;
        $history->evolucion_final = $request->evolucion_final;
        $history->concepto_profesional = $request->concepto_profesional;
        $history->recomendaciones = $request->recomendaciones;
        $history->fecha_hora = $request->fecha_hora;

        $history->save();
        // evento para notificar al paciente que se ha creado una historia
        event(new HistoriaCreada($history));
        // retornar un mensaje de exito
        return response()->json(['message' => 'Historia creada exitosamente', 'status' => 200]);

    }


}
