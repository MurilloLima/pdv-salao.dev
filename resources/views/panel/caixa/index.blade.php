@extends('panel.includes.app',['activePage' => 'caixa.index'])

@section('title')
Caixa
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
                        <li class="breadcrumb-item active">Caixa</li>
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
                            <h3 class="card-title">Caixa aberto (tickets)</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nº Ticket</th>
                                        <th>Cliente</th>
                                        <th>Data</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td><a
                                                href="{{ route('ticket.itens', ['id'=>$item->id]) }}">{{$item->token}}</a>
                                        </td>
                                        <td>{{$item->cliente->name}}</td>
                                        <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                        <td>
                                            <a href="{{ route('ticket.itens', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-success" title="Visualizar">Em
                                                aberto
                                                {{-- <i class="fas fa-view"></i> --}}
                                            </a>
                                            @if(auth()->user()->role == 'admin')
                                            <a href="{{ route('admin.ticket.delete', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-default" title="Deletar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhum ticket aberto no momento!!!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $data->links() }}
                            </ul>
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