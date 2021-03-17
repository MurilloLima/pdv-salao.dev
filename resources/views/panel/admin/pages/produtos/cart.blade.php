@extends('panel.includes.app',['activePage' => 'admin.product.index'])

@section('title')
Carrinho de produtos
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
                        <li class="breadcrumb-item"><a href="#">Carrinho</a></li>
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

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Qtd</th>
                                        <th>valor</th>
                                        <th>Desconto</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->product->name}}</td>
                                        <td>{{$item->qtd}}</td>
                                        <td>R$ {{$item->valor}}</td>
                                        <td>{{$item->desc}}</td>
                                        <td>
                                            @if (auth()->user()->role == 'admin')
                                            <a href="{{ route('panel.cart.delete.item', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-default" title="Deletar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhum produto adicionado no carrinho
                                            momento!!!</td>
                                    </tr>

                                    @endforelse
                                    <tr>
                                        <td colspan="6" class="text-right">
                                            <h4><strong>Total: R$ {{number_format($total, 2, ',', '.')}}</strong></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @if (auth()->user()->role == 'operador')
                            @else
                            <div style="margin-top: 10px">
                                <a href="{{ route('panel.cart.finalizar') }}" class="btn btn-app" style="background-color: green; color: white;"><i
                                        class="fa fa-barcode"></i>
                                    Finalizar
                                </a>
                            </div>
                            @endif

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                
        </div>
    </div>
    {{-- end content --}}
</section>

@endsection