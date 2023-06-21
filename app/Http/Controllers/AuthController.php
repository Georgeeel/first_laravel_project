<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login'); 
    }
    public function logout()
    {
        Auth::logout();
        return to_route('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        // authentification d'utilisateur
       $credentials = $request->validated();

        // method attempt prendre en parametre un tableau de credentials(email et mot de passe)
        // et verif si les informations sont valides
        // si le utilisateur à été bien connecté on va utilisé la session et je vais regenere la session grace à method 
       if(Auth::attempt($credentials)){
        //sauvegarder l'utilisateur un session    
        $request->session()->regenerate();
        // une fois regenéré la session redirection le user
        // méthode intended permet de rediriger vers la route d'origine et si n'existe pas il va vers la route precisé
        return redirect()->intended(route('blog.index'));

       };
    //    si le user il a indiquer le mauvaise information il est rediriger vers la route...
       return to_route('auth.login')->withErrors([
        "email" => "Email invalid"
       ])->onlyInput('email');
    }
}
