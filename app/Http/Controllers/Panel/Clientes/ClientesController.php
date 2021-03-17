<?php

namespace App\Http\Controllers\Panel\Clientes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;

class ClientesController extends Controller
{
    public function index()
    {
        $data = Cliente::orderby('id', 'desc')->paginate(50);
        return view('panel.clientes.index', compact('data'));
    }

    public function store(ClienteRequest $request)
    {
        if ($request->file('avatar') == null) {
            Cliente::create($request->all());
        } else {
            if ($files = $request->file('avatar')) {
                $destinationPath = public_path('/upload/avatar/'); // upload path
                // Upload Orginal Image           
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);

                $insert['image'] = "$profileImage";
                // Save In Database
                $client = new Cliente();
                $client->name = $request->get('name');
                $client->fone = $request->get('fone');
                $client->cpf = $request->get('cpf');
                $client->date_nasc = $request->get('date_nasc');
                $client->avatar = "$profileImage";
                $client->save();
            }
        }
        return redirect()->to('clientes/')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function update($id, Request $request)
    {
        $client = Cliente::find($id);
        if ($request->file('avatar') == null) {
            $client->update($request->all());
        } else {
            if ($files = $request->file('avatar')) {
                $destinationPath = public_path('/upload/avatar/'); // upload path
                // Upload Orginal Image           
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);

                $insert['image'] = "$profileImage";
                // Save In Database
                $client->name = $request->get('name');
                $client->fone = $request->get('fone');
                $client->cpf = $request->get('cpf');
                $client->date_nasc = $request->get('date_nasc');
                $client->avatar = "$profileImage";
                $client->save();
            }
        }

        return redirect()->back()->with('success', 'Cliente atualizado com sucesso!');
    }

    public function delete($id)
    {
        Cliente::destroy($id);
        return redirect()->back()->with('success', 'Cliente deletado com sucesso!');
        # code...
    }

    public function search(Request $request)
    {
        $value = $request->get('value');
        $data = Cliente::where('name', 'like', '%' . $value . '%')->orderby('created_at', 'desc')->paginate();
        return view('panel.clientes.index', compact('data'));
    }
}
