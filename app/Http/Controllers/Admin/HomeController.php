<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function profile() {
        return view('admin.profile');
    }

    public function generateToken() {
        // GENERIAMO UNA STRINGA RANDOM DI 80 CARATTERI
        $api_token = Str::random(80);
        // ASSEGNIAMO L'API TOKEN GENERATO ALL'UTENTE CORRENTE
        $user = Auth::user();
        $user->api_token = $api_token;
        $user->save();
        return redirect()->route('admin.profile');
    }
}
