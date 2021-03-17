@extends('panel.includes.app',['activePage' => 'admin.relatorios.index'])

@section('title')
Relatório
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
                        <li class="breadcrumb-item active">Resultado Relatório</li>
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
                            <h3 class="card-title">Resultado Relatório</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nº Ticket</th>
                                        <th>Cliente</th>
                                        <th>R$</th>
                                        <th>Valor dinheiro</th>
                                        <th>Valor cartão</th>
                                        <th>Nª Parcelas</th>
                                        <th>Data</th>
                                        <th>Valor total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->token}}</td>
                                        <td>{{$item->cliente->name}}</td>
                                        <td>{{$item->payment}}</td>
                                        <td>
                                            @if ($item->valor_dinheiro > 0)
                                            {{number_format($item->valor_dinheiro, 2, ',', '.')}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->valor_cartao > 0)
                                            {{number_format($item->valor_cartao, 2, ',', '.')}}
                                            @endif
                                        </td>
                                        <td>{{$item->n_parcelas}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                        <td>{{number_format($item->itens->sum('valor'), 2, ',', '.')}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Nenhum registro encontrado!!!</td>
                                    </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="9" class="text-right">
                                            @if (count($data) >= 1)
                                            <h5>
                                                Total dinheiro: R$:
                                                {{number_format($data->sum('valor_dinheiro'), 2,',','.')}} <br>

                                                Total cartão: R$:
                                                {{number_format($data->sum('valor_cartao'), 2,',','.')}} <br>

                                                Total dinheiro/Cartão: R$:
                                                {{number_format($dinheiroCartao->sum('total'), 2,',','.')}}
                                            </h5>
                                            @else

                                            @endif

                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <div class="card-header">
                                <h3 class="card-title">Contas pagas</h3>
                            </div>
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                </thead>
                                <tbody>
                                    @forelse ($contasPagas as $item)
                                    <tr>
                                        <td>{{$item->desc}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                        <td>{{number_format($item->valor, 2,',','.')}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">Nenhuma conta paga</td>
                                    </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="3" class="text-right">
                                            @if (count($contasPagas) >= 1)
                                            <h5>
                                                Total pago: R$:
                                                {{number_format($contasPagas->sum('valor'), 2,',','.')}} <br>
                                            </h5>
                                            @else

                                            @endif

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <div class="card-header">
                                <h3 class="card-title">Contas recebidas</h3>
                            </div>
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                </thead>
                                <tbody>
                                    @forelse ($contasRecebidas as $item)
                                    <tr>
                                        <td>{{$item->desc}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                        <td>{{number_format($item->valor, 2,',','.')}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">Nenhuma conta recebida</td>
                                    </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="3" class="text-right">
                                            @if (count($contasRecebidas) >= 1)
                                            <h5>
                                                Total recebido: R$:
                                                {{number_format($contasRecebidas->sum('valor'), 2,',','.')}} <br>
                                            </h5>
                                            @else

                                            @endif

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-body text-right">
                            @if (count($data) >= 1)
                            <h4>
                                @php
                                $pagas = $contasRecebidas->sum('valor') + $data->sum('total');
                                $total = $pagas - $contasPagas->sum('valor');
                                @endphp
                                <strong>Total: R$:
                                    {{number_format($total, 2,',','.')}}</strong>
                            </h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
</section>

@endsection