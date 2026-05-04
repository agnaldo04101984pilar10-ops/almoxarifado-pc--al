<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Importante para criar o usuário
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Importante para criptografar a senha

class AuthController extends Controller
{
    // Mostra a tela de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Mostra a tela de registro (aquela que o link 'register' chama)
    public function showRegistro()
    {
        return view('auth.registro');
    }

    // Processa o cadastro do novo usuário
    public function registro(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'setor' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'setor' => $request->setor,
            'tipo_usuario' => 'instituto', 
            'status' => 'pendente' // Começa travado para sua aprovação
        ]);

        return redirect()->route('login')->with('success', 'Solicitação enviada! Aguarde a aprovação do Almoxarifado.');
    }

    // Processa o login (com a trava de status ativo)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // VERIFICA SE O USUÁRIO ESTÁ ATIVO
            if (Auth::user()->status !== 'ativo') {
                Auth::logout();
                return back()->withErrors(['email' => 'Seu cadastro ainda está em análise pelo Almoxarifado Central.']);
            }

            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais informadas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    // Funções para o Admin Central aprovar novos membros
    public function listaPendentes()
    {
        $usuarios = User::where('status', 'pendente')->get();
        return view('auth.pendentes', compact('usuarios'));
    }

    public function aprovar($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'ativo']);
        return back()->with('success', "Usuário {$user->name} aprovado com sucesso!");
    }

    // Desloga o usuário
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}