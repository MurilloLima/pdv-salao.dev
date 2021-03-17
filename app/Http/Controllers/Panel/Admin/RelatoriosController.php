<?php

namespace App\Http\Controllers\Panel\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountHistory;
use App\Models\Cart;
use App\Models\Cliente;
use App\Models\FinishCart;
use App\Models\Servico;
use App\Models\Ticket;
use App\User;

class RelatoriosController extends Controller
{
    public function index()
    {
        $users = User::all();
        $clientes = Cliente::all();
        $servicos = Servico::all();
        $tickets = Ticket::where('status', 'aberto')->get();
        return view('panel.admin.pages.relatorios.index', compact('users', 'clientes', 'servicos', 'tickets'));
        # code...
    } //


    public function day(Request $request)
    {
        $contasPagas = AccountHistory::where('tipo', 1)->whereDate('created_at', $request->get('day'))->get();
        $contasRecebidas = AccountHistory::where('tipo', 2)->whereDate('created_at', $request->get('day'))->get();

        $dinheiro = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Dinheiro'
        ])->whereDate('created_at', $request->get('day'))->get();
        $cartao = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Cartão'
        ])->whereDate('created_at', $request->get('day'))->get();
        $dinheiroCartao = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Dinheiro/Cartão'
        ])->whereDate('created_at', $request->get('day'))->get();
        $data = Ticket::where('status', 'finalizado')->whereDate('created_at', $request->get('day'))->get();
        $products = Cart::whereMonth('created_at', $request->get('month'))->get();
        return view('panel.admin.pages.relatorios.resultado', compact('data', 'dinheiro', 'cartao', 'dinheiroCartao', 'contasPagas', 'contasRecebidas', 'products'));
    }

    public function month(Request $request)
    {
        $contasPagas = AccountHistory::where('tipo', 1)->whereMonth('created_at', $request->get('month'))->get();
        $contasRecebidas = AccountHistory::where('tipo', 2)->whereMonth('created_at', $request->get('month'))->get();

        $dinheiro = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Dinheiro'
        ])->whereMonth('created_at', $request->get('month'))->get();
        $cartao = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Cartão'
        ])->whereMonth('created_at', $request->get('month'))->get();
        $dinheiroCartao = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Dinheiro/Cartão'
        ])->whereMonth('created_at', $request->get('month'))->get();
        $data = Ticket::where('status', 'finalizado')->whereMonth('created_at', $request->get('month'))->get();
        $products = Cart::whereMonth('created_at', $request->get('month'))->get();
        return view('panel.admin.pages.relatorios.resultado', compact('data', 'dinheiro', 'cartao', 'dinheiroCartao', 'contasPagas', 'contasRecebidas', 'products'));
    }

    public function year(Request $request)
    {
        $contasPagas = AccountHistory::where('tipo', 1)->whereYear('created_at', $request->get('year'))->get();
        $contasRecebidas = AccountHistory::where('tipo', 2)->whereYear('created_at', $request->get('year'))->get();

        $dinheiro = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Dinheiro'
        ])->whereYear('created_at', $request->get('year'))->get();
        $cartao = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Cartão'
        ])->whereYear('created_at', $request->get('year'))->get();
        $dinheiroCartao = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Dinheiro/Cartão'
        ])->whereYear('created_at', $request->get('year'))->get();
        $data = Ticket::where('status', 'finalizado')->whereYear('created_at', $request->get('year'))->get();
        $products = Cart::whereYear('created_at', $request->get('year'))->get();
        return view('panel.admin.pages.relatorios.resultado', compact('data', 'dinheiro', 'cartao', 'dinheiroCartao', 'contasPagas', 'contasRecebidas', 'products'));
    }

    public function personalizado(Request $request)
    {
        $date_start = $request->get('date1');
        $date_end = $request->get('date2');

        $contasPagas = AccountHistory::where('tipo', 1)->whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end)->get();
        $contasRecebidas = AccountHistory::where('tipo', 2)->whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end)->get();
        $dinheiro = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Dinheiro'
        ])->whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end)->get();
        $cartao = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Cartão'
        ])->whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end)->get();
        $dinheiroCartao = Ticket::where([
            'status' => 'finalizado',
            'payment' => 'Dinheiro/Cartão'
        ])->whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end)->get();

        $data = Ticket::where('status', 'finalizado')->whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end)->get();

        $products = Cart::whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end)->get();
        return view('panel.admin.pages.relatorios.resultado', compact('data', 'dinheiro', 'cartao', 'dinheiroCartao', 'contasPagas', 'contasRecebidas', 'products'));
    }
}
