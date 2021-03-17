<?php

namespace App\Http\Controllers\Panel\Operador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $data = User::find(auth()->user()->id);
        return view('panel.operador.pages.profile.edit', compact('data'));
    }
}
