<?php

namespace App\Http\Controllers\Panel\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItensRequest;
use App\Http\Requests\TicketRequest;
use App\Models\Iten;
use App\Models\Servico;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade as PDF;
use Keygen\Keygen;

class TicketController extends Controller
{
    public function index($id)
    {
        $ticket = Ticket::find($id);
        $data = $ticket->itens;
        $total = $ticket->itens->sum('valor');
        $servicos = Servico::orderby('name', 'desc')->get();
        return view('panel.ticket.itens.index', compact('data', 'ticket', 'servicos', 'total'));
    }

    public function store($id)
    {
        $check = Ticket::where(['cliente_id' => $id, 'status' => 'aberto'])->first();
        if ($check == true) {
            return redirect()->back()->with('error', 'O cliente já possui um ticket aberto.');
        }
        Ticket::create([
            'cliente_id' => $id,
            'token' => Keygen::numeric(10)->generate(),
            'status' => 'aberto'
        ]);
        return redirect()->to('caixa/')->with('success', 'Ticket aberto com sucesso, agora basta adicionar os serviços para o novo ticket.');
    }

    public function delete($id)
    {
        Ticket::destroy($id);
        return redirect()->back()->with('success', 'Ticket deletado com sucesso.');
    }

    public function addItens(ItensRequest $request)
    {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $request->get('valor'));

        Iten::create([
            'ticket_id' => $request->get('ticket_id'),
            'servico' => $request->get('servico'),
            'valor' => $valor,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->back()->with('success', 'Serviço adicionado com sucesso.');
    }

    public function deleteItem($id)
    {
        Iten::destroy($id);
        return redirect()->back()->with('success', 'Serviço removido do ticket com sucesso.');
        # code...
    }

    public function finaliza($id, Request $request)
    {
        $ticket = Ticket::find($id);
        
        $source = array('.', ',');
        $replace = array('', '.');
        
        $valor_dinheiro = str_replace($source, $replace, $request->get('valor_dinheiro'));
        $valor_cartao = str_replace($source, $replace, $request->get('valor_cartao'));

        $total = $ticket->itens->sum('valor');
        
        $ticket->update([
            'status' => 'finalizado',
            'payment' => $request->get('payment'),
            'n_parcelas' => $request->get('n_parcelas'),
            'valor_dinheiro' => $valor_dinheiro,
            'valor_cartao' => $valor_cartao,
            'total' => $total
        ]);
        $data = $ticket->itens;
        return view('panel.ticket.itens.print', compact('data', 'ticket', 'total'))->with('success', 'ticket finalizado com sucesso.');
    }

    public function print($id)
    {
        $ticket = Ticket::find($id);
        $total = $ticket->itens->sum('valor');
        $data = $ticket->itens;

        $pdf = PDF::loadView('panel.admin.pages.pdf.print', [
            'data' => $data,
            'total' => $total,
            'ticket' => $ticket
        ]);
        // return $pdf->stream('invoice.pdf');
        return $pdf->download('ticket.pdf');
    }
}
