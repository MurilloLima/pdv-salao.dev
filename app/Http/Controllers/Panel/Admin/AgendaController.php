<?php

namespace App\Http\Controllers\Panel\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Cliente::orderby('name', 'asc')->get();
        $data = Agenda::orderby('date', 'desc')->paginate();
        return view('panel.admin.pages.agenda.index', compact('data', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Agenda::create($request->all());
        return redirect()->back()->with('success', 'Agendamento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $data = Agenda::find($id);
        $data->update($request->all());
        return redirect()->back()->with('success', 'Editado criado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Agenda::destroy($id);
        return redirect()->back()->with('success', 'Deletado criado com sucesso!');
    }

    public function search(Request $request)
    {
        $date_start = date('Y-m-d', strtotime($request->get('date-start')));
        $date_end = date('Y-m-d', strtotime($request->get('date-end')));

        $data = Agenda::whereDate('date', '>=', $date_start)->whereDate('date', '<=', $date_end)->orderby('date', 'asc')->paginate(50);
        $clients = Cliente::orderby('name', 'asc')->get();
        return view('panel.admin.pages.agenda.index', compact('data', 'clients'));
    }
}
