@extends('panel.includes.app', ['activePage' => 'admin.product.index'])
@section('title', 'Cadastrar produto')

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
                    <li class="breadcrumb-item active">Cadastrar produto</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6">
                @include('panel.includes.alerts')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Cadastrar produto
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    {!! Form::open(['route'=>'admin.product.store']) !!}
                    <div class="card-body">
                        @include('panel.admin.pages.produtos.form._form')
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-info float-right">
                            <i class="fas fa-plus"></i>
                            Cadastrar
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection