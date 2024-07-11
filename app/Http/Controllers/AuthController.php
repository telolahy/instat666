<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // Rediriger vers la page d'accueil si l'utilisateur est déjà authentifié
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        // Valider les entrées
         $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Essayer d'authentifier l'utilisateur
        if (Auth::attempt($request->only('email', 'password'))) {
            // Rediriger vers la page d'accueil en cas de succès
            return redirect()->route('home');
        }

        // Rediriger avec un message d'erreur en cas d'échec
        return redirect()->back()->withErrors(['email' => 'Les identifiants ne correspondent pas.']);
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login')->with('status', 'Vous avez été déconnecté avec succès.');
    }
}