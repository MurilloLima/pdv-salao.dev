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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Buscar produto</h3> --}}
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
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Valor</th>
                                        <th>Estoque</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>R$ {{number_format($item->valor, 2, ',','.')}}</td>
                                        <td>{{$item->qtd}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm" title="Adicionar"
                                                data-toggle="modal" data-target="#additem{{$item->id}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <div class="modal fade" id="additem{{$item->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Adicionar item</h4>
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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th colspan="5">Itens adicionados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cart as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>R$ {{number_format($item->valor, 2, ',','.')}}</td>
                                        <td>{{$item->qtd}}</td>
                                        {{-- <td>{{number_format($item->desc, 2, ',','.')}}</td> --}}
                                        <td>
                                            <a href="{{ route('panel.cart.delete.item', ['id'=>$item->id]) }}"
                                                title="remover">
                                                <i class="fas fa-trash-alt"></i>
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
                        <div class="text-right p-3">
                            <h4>Desconto: R${{number_format($desconto, 2, ',', '.')}}</h4>
                            <h2><strong>Total: R${{number_format($total, 2, ',', '.')}}</strong></h2>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('panel.cart.finalizar') }}" class="btn btn-lg btn-primary">Finalizar</a>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
    {{-- end content --}}
</section>
@endsection