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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de produtos</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                                    <i class="nav-icon fa fa-plus"></i> Add novo</a>
                                <a href="{{ route('admin.products.list') }}" class="btn btn-dark">
                                    <i class="nav-icon fa fa-plus"></i> Nova venda</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>descrição</th>
                                        <th>Valor</th>
                                        <th>Qtd Estoque</th>
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
                                            <a href="{{ route('admin.product.edit', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-default" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.product.delete', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-default" title="Deletar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
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
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
</section>
@endsection