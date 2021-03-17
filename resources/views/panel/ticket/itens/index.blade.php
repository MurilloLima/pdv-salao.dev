@extends('panel.includes.app',['activePage' => 'caixa.index'])

@section('title')
Ticket
@endsection

@section('content')
<section class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Caixa</a></li>
                        <li class="breadcrumb-item active">Ticket</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    {{-- content --}}
    <div class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('panel.includes.alerts')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tickets: <strong>#{{$ticket->token}}</strong></h3> <br>
                            <p>Cliente: <strong>{{$ticket->cliente->name}}</strong> <br>
                                Data abertura:
                                <strong>{{date('d/m/Y H:i:s', strtotime($ticket->created_at))}}</strong></p>
                            <div class="card-tools">
                                <a href="#" data-toggle="modal" data-target="#add" class="btn btn-primary">
                                    <i class="nav-icon fa fa-plus"></i> Add serviços</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Serviços</th>
                                        <th>valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->servico}}</td>
                                        <td>R$ {{$item->valor}}</td>
                                        <td>
                                            @if (auth()->user()->role == 'admin')
                                            <a href="{{ route('ticket.item.delete', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-default" title="Deletar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum serviço adicionado no momento!!!</td>
                                    </tr>

                                    @endforelse
                                    <tr>
                                        <td colspan="4" class="text-right">
                                            <h4><strong>Total: R$ {{number_format($total, 2, ',', '.')}}</strong></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @if (auth()->user()->role == 'operador')
                            @else
                            <div style="margin-top: 10px">
                                <a href="#" data-toggle="modal" data-target="#finalizar" class="btn btn-app"
                                    style="background-color: green; color: white;"><i class="fa fa-barcode"></i>
                                    Finalizar ticket
                                </a>
                            </div>
                            @endif

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
</section>

<!-- Modal item-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar
                    serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ticket.itens.store') }}" class="navbar-form" method="post">
                    @csrf
                    @method('post')
                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Serviço') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('servico') ? ' has-danger' : '' }}">
                                    <input type="text" class="form-control" name="servico">
                                    @if ($errors->has('servico'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('servico') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Valor (R$)') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('valor') ? ' has-danger' : '' }}">
                                    <input type="text" class="form-control money2" name="valor" placeholder="0,00"
                                        required>
                                    @if ($errors->has('valor'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('valor') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal item-->
<div class="modal fade" id="finalizar" tabindex="-1" role="dialog" aria-labelledby="finalizar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Finalizar
                    venda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ticket.finaliza', ['id'=>$ticket->id]) }}" class="navbar-form" method="get">
                    @csrf
                    @method('get')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Forma pag.') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('payment') ? ' has-danger' : '' }}">
                                    <select name="payment" class="form-control" required>
                                        <option value="Dinheiro">Dinheiro</option>
                                        <option value="Cartão">Cartão</option>
                                        <option value="Dinheiro/Cartão">Dinheiro/Cartão
                                        </option>
                                    </select>
                                    @if ($errors->has('payment'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('payment') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Valor') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('valor_dinheiro') ? ' has-danger' : '' }}">
                                    <input type="text" class="form-control money" name="valor_dinheiro"
                                        placeholder="0.00" value="0">
                                    @if ($errors->has('valor_dinheiro'))
                                    <span id="valor_dinheiro-error"
                                        class="error text-danger">{{ $errors->first('valor_dinheiro') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Valor cartão') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('valor_cartao') ? ' has-danger' : '' }}">
                                    <input type="text" class="form-control money" name="valor_cartao"
                                        placeholder="0.00" value="0">
                                    @if ($errors->has('valor_cartao'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('valor_cartao') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Nº Parcelas') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('n_parcelas') ? ' has-danger' : '' }}">
                                    <input type="number" class="form-control" name="n_parcelas" placeholder="0">
                                    @if ($errors->has('n_parcelas'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('n_parcelas') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Finalizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection