@extends('panel.includes.app',['activePage' => 'admin.product.index'])

@section('title')
Venda de produto finalizada
@endsection

@section('content')
<section class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">venda finalizada</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Carrinho</a></li>
                        <li class="breadcrumb-item active">Venda de produto finalizada</li>
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
                            <h3 class="card-title">UID: <strong>#{{$uid}}</strong></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Qtd</th>
                                        <th>Valor</th>
                                        <th>Desconto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->product->name}}</td>
                                        <td>{{$item->qtd}}</td>
                                        <td>R$ {{$item->valor}}</td>
                                        R$ {{$item->desc}}
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum produto encontrado!!!</td>
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