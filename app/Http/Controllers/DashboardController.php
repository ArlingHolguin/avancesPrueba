<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
    public function index(){
        $userLogin = Auth::user()->load([
            'roles:name'
        ]);
        $histories = $userLogin->historiasComoPaciente()->get();
        return Inertia::render('Dashboard', [
            'roles' => auth()->user()->roles,
            'permissions' => auth()->user()->permissions,
            'userLogin' => $userLogin,
            'histories' => $histories
        ]);
    }

}
