<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['__invoke', 'login']);
    }
    
    public function __invoke()
    {   
        return view('login.admin');
    }

    public function login(Request $request)
    {
        // Validar que el campo de usuario no esté vacío
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
    
        // Obtener el campo de usuario y la contraseña
        $userInput = $request->input('name');
        $password = $request->input('password');
    
        // Determinar si el input es un email o un nombre de usuario
        $field = filter_var($userInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
    
        // Intentar autenticar en administradores
        if (Auth::guard('admin')->attempt([$field => $userInput, 'password' => $password])) {
            return redirect()->intended(route('events.index'))->with('success', 'Se ha inciciado sesión correctamente \n Bienvenid@ ' . auth()->guard('admin')->user()->name);
        }

        return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.');
    }
    
    public function updateDetails(Request $request){
        // Validación de los datos

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|file|mimes:jpg,png,svg|max:2048',
        ]);

        $id = auth()->user()->id;
        $user = Administrator::findOrFail($id);

        // Consultar si hemos obtenido la imagen y si es valida
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Guardaremos la imagen en la ruta personalizada a partir de la carpeta public
            $filePath = $request->file('image')->store($id . $request->input('name'), 'public');
            $validatedData['image'] = $filePath;
        }

        // Actualizar el evento con los datos validados
        $user->update($validatedData);

        return redirect()->route('admin.settings')->with('success', 'Informacion de usuario actualizada correctamente');
    }

    public function updatePassword(Request $request){
        // Validación de los datos

        $validatedData = $request->validate([
            'newPassword' => 'required|string|max:255',
            'confirmNewPassword' => 'required|string|max:255',
        ]);

        if ($request->input('newPassword') != $request->input('confirmNewPassword')){
            return redirect()->route('admin.settings')->with('error', "Error, las contraseñas no coinciden.");
        }

        $id = auth()->user()->id;
        $user = Administrator::findOrFail($id);

        // Actualizar el evento con los datos validados
        $user->password = bcrypt($validatedData['newPassword']);
        $user->save();

        return redirect()->route('admin.settings')->with('success', 'Cotraseña actualizada correctamente');
    }

    public function registerLikeUser()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Se ha cerrado sesión correctamente');
    }

    public function showSettings(){
        return view('back.settings');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.index');
    }

    public static function getAdministrators($mainAdmin_id)
    {
        return Administrator::where('user_id', $mainAdmin_id)->get();
    }

}
