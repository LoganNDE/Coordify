<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegister;
use Throwable;

class GoogleAuthController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            return redirect()->route('login')->with('error', 'La autenticación con Google ha fallado');
        }
    
        $existingUser = User::where('email', $user->email)->first();
    
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $baseName = $user->name;
            $finalName = $baseName;
            $suffix = 1;
    
            while (User::where('name', $finalName)->exists()) {
                $finalName = $baseName . '-' . $suffix;
                $suffix++;
            }
    
            $newUser = User::create([
                'name' => $finalName,
                'email' => $user->email,
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now()
            ]);
            $newUser->save();
    
            Auth::login($newUser);
            Mail::to($newUser->email)->send(new UserRegister($newUser));

        }
    
        return redirect()->route('front.index')->with('success', 'Se ha iniciado sesión correctamente');
    }
}
