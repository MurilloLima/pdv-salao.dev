<?php

namespace App\Http\Controllers\Panel\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Requests\Auth\UsersRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $data = User::orderby('name', 'desc')->paginate();
        return view('panel.admin.pages.users.index', compact('data'));
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('panel.admin.pages.users.edit', compact('data'));
    }

    public function store(UsersRequest $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
            'password' => Hash::make($request->get('password'))
        ]);
        return redirect()->back()->with('success', 'Novo usuário cadastrado com sucesso!');

    }

    public function update($id, ProfileRequest $request)
    {
        $data = User::find($id);
        $data->update($request->all());
        return back()->withStatus(__('Perfil atualizado com sucesso.'));
    }

    public function password($id, PasswordRequest $request)
    {
        $data = User::find($id);
        $data->update(['password' => Hash::make($request->get('password'))]);
        return back()->withStatusPassword(__('Senha atualizada com sucesso.'));
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Deletado com sucesso!');
    }
}
