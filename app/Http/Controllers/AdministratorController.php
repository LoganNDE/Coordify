<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        //Si queremos utilizar property_existe, debemos de asegurarnos previamente que el usuario este logeado;
        if (auth()->check() && !property_exists(auth()->user(), 'user_id')){
            return view('app.newadmin');
        }else{
            return redirect()->route('events.index')->with('error','No tienes permisos para agregar administradores');
        }
    }


    public function newadmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',

        ]);
        
        if ($request->input('email') === auth()->user()->email){
            return redirect()->route('events.settings')->with('error', 'El correo debe ser distinto al del administrador principal');
        }

        $admin = new Administrator();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = bcrypt('admin');
        $admin->user_id = auth()->user()->id;
        $admin->save();
        return redirect()->route('events.index')->with('success', 'Nuevo administrador registrado correctamente');
    }
}
