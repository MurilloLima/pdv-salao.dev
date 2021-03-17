<?php

namespace App\Http\Controllers\Panel\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountHistory;

class AccountController extends Controller
{
    public function index()
    {
        $pagas = Account::where('tipo', 1)->sum('valor');
        $receber = Account::where('tipo', 2)->sum('valor');
        $data = Account::orderby('created_at', 'desc')->paginate(50);
        return view('panel.admin.pages.accounts.index', compact('data', 'pagas', 'receber'));
        # code...
    }

    public function store(Request $request)
    {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $request->get('valor'));

        Account::create([
            'tipo' => $request->get('tipo'),
            'desc' => $request->get('desc'),
            'valor' => $valor,
        ]);
        AccountHistory::create([
            'tipo' => $request->get('tipo'),
            'desc' => $request->get('desc'),
            'valor' => $valor,
        ]);
  
        return redirect()->back()->with('success', 'Cadastrado com sucesso.');
    }

    public function delete($id)
    {
        Account::destroy($id);
        return redirect()->back()->with('success', 'Deletado com sucesso.');
    }

    public function zerar()
    {
       Account::truncate();
       return redirect()->back()->with('success', 'Todos os registros foram deletados.');

    }
}
