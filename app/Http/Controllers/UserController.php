<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Exception;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __construct()
    {
        $this->middleware('auth:web,admin')->only(['showSettings', 'updateDetails', 'updatePassword', 'logout']);
    }

    public function __invoke()
    {
        return view('login.index');
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
    
        if (Auth::guard('web')->attempt([$field => $userInput, 'password' => $password])) {
            return redirect()->intended(route('events.index'))->with('success', 'Se ha inciciado sesión correctamente. \n Bienvenid@ ' . auth()->user()->name);
        }

        return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.');
    }


    public function register(Request $request)
    {
        // Validar que el campo de usuario no esté vacío
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'verifyPassword' => 'required',
        ]);
        

        if ($request->input('password') != $request->input('verifyPassword')) {
            return redirect()->route('user.register')->with('error', 'Las contraseñas no coinciden');
        } elseif (User::where('email', $request->input('email'))->exists()) {
            return redirect()->route('user.register')->with('error', 'Este correo ya se encuentra registrado');
        } elseif (User::where('name', $request->input('name'))->exists()) {
            return redirect()->route('user.register')->with('error', 'Este nombre de usuario ya se encuentra registrado');
        }



        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        Auth::login($user);

        return redirect()->route('front.index')->with('success', 'Registro completado');
    }

    public function showRegister()
    {
        return view('login.register');
    }



    public function updateDetails(Request $request){
            // Validación de los datos

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'image' => 'nullable|file|mimes:jpg,png,svg|max:2048',
            ]);

            $id = auth()->user()->id;
            $user = User::findOrFail($id);

            // Consultar si hemos obtenido la imagen y si es valida
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Guardaremos la imagen en la ruta personalizada a partir de la carpeta public
                $filePath = $request->file('image')->store($id . $request->input('name'), 'public');
                $validatedData['image'] = $filePath;
            }
    
            $user->update($validatedData);


            return redirect()->route('user.settings')->with('success', 'Informacion de usuario actualizada correctamente');
    }


    public function updatePassword(Request $request){
        // Validación de los datos

        $validatedData = $request->validate([
            'newPassword' => 'required|string|max:255',
            'confirmNewPassword' => 'required|string|max:255',
        ]);

        if ($request->input('newPassword') != $request->input('confirmNewPassword')){
            return redirect()->route('user.settings')->with('error', "Error, las contraseñas no coinciden.");
        }

        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        // Actualizar el evento con los datos validados
        $user->password = bcrypt($validatedData['newPassword']);
        $user->save();

        return redirect()->route('user.settings')->with('success', 'Cotraseña actualizada correctamente');
    }

    public function showSettings(){
        if (auth('admin')->check()){
            return redirect()->route('admin.settings');
        }
        return view('back.settings');
    }



    public function showNewAdmin()
    {
        //Si queremos utilizar property_existe, debemos de asegurarnos previamente que el usuario este logeado;
        if (auth()->check() && !property_exists(auth()->user(), 'user_id')){
            return view('back.newadmin');
        }else{
            return redirect()->route('events.index')->with('error','No tienes permisos para agregar administradores');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.index');
    }
}
