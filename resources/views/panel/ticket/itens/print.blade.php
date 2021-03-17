@extends('panel.includes.app',['activePage' => 'admin.caixa.index'])

@section('title')
Ticket finalizado
@endsection

@section('content')
<section class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ticket finalizado</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Caixa</a></li>
                        <li class="breadcrumb-item active">Ticket finalizado</li>
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
                            <div class="card-tools">
                                <a href="{{ route('ticket.print', ['id'=>$ticket->id]) }}"
                                    style="background-color: darkcyan; color: white" class="btn btn-app"><i
                                        class="fa fa-print"></i>
                                    Imprimir
                                </a>

                            </div>
                            
                            <h3 class="card-title">Tickets: <strong>#{{$ticket->token}}</strong></h3> <br>
                            <p>Cliente: <strong>{{$ticket->cliente->name}}</strong> <br>
                                Data:
                                <strong>{{date('d/m/Y H:i:s', strtotime($ticket->created_at))}}</strong></p>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Serviços</th>
                                        <th>valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->servico}}</td>
                                        <td>R$ {{$item->valor}}</td>
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
@endsection