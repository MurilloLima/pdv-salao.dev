<?php

namespace App\Http\Controllers\Panel\Caixa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;

class CaixaController extends Controller
{
    public function index()
    {
        $data = Ticket::where('status', 'aberto')->paginate(50);
        return view('panel.caixa.index', compact('data'));
    }
}
