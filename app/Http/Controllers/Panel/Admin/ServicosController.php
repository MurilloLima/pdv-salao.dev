<?php

namespace App\Http\Controllers\Panel\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicosRequest;
use App\Models\Servico;

class ServicosController extends Controller
{
    public function index()
    {
        $data = Servico::orderby('id', 'desc')->paginate();
        return view('panel.admin.pages.servicos.index', compact('data'));
    }

    public function store(ServicosRequest $request)
    {
        Servico::create([
            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            'valor' => str_replace(',', '.', $request->get('valor'))
        ]);
        return redirect()->back()->with('success', 'Cadastrado com sucesso!');
    }

    public function update($id, ServicosRequest $request)
    {
        $data = Servico::find($id);
        $data->update([
            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            'valor' => str_replace(',', '.', $request->get('valor'))
        ]);
        return redirect()->back()->with('success', 'Atualziado com sucesso!');
    }

    public function delete($id)
    {
        Servico::destroy($id);
        return redirect()->back()->with('success', 'Deletado com sucesso!');
        # code...
    }
}
