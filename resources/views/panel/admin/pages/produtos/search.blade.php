@extends('panel.includes.app',['activePage' => 'admin.product.index'])

@section('title')
Produtos
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
                        <li class="breadcrumb-item active">Produtos</li>
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Itens</h3>
                            <div class="card-tools">
                                <form action="{{ route('admin.product.search') }}" method="get">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="value" class="form-control float-right"
                                            placeholder="Pesquisar">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Valor</th>
                                        <th>Qtd</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->desc}}</td>
                                        <td>R$ {{number_format($item->valor, 2, ',','.')}}</td>
                                        <td>{{$item->qtd}}</td>
                                        <td>
                                            <a href="" title="remover">
                                                <i class="fa fa-task"></i>
                                            </a>
                                            <div class="modal fade" id="additem{{$item->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Adicionar item ao carrinho</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        {!! Form::open(['route' => ['admin.product.addItem',
                                                        $item->id]]) !!}
                                                        <div class="modal-body">
                                                            <p>{{$item->name}}</p>
                                                            <h3><strong>R$: {{$item->valor}}</strong></h3>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="">Quantidade</label>
                                                                        <input type="number" class="form-control"
                                                                            name="qtd" placeholder="0">
                                                                    </div>
                                                                </div>

                                                                <div class="col-9">
                                                                    <div class="form-group">
                                                                        <label for="">Desconto</label>
                                                                        <input type="text" class="form-control money2"
                                                                            name="desc" value="0" placeholder="0">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Fechar</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Adicionar</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            {{-- modal --}}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhum encontrado!!!</td>
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
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
</section>
@endsection