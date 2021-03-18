@extends('panel.includes.app', ['activePage' => 'admin.product.index'])
@section('title', 'Venda finalizada')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Venda finalizada</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-success"><h1>Venda finalizada com sucesso!</h1></div>
                <a href="{{ route('panel.cart.print', ['cart'=>$cart->uid]) }}" target="_blank" class="btn btn-lg btn-primary">Imprimir</a>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection