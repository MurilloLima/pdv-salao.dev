@extends('panel.includes.app',['activePage' => 'admin.index'])

@section('title')
Home
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center"><br>
                <img src="{{ asset('assets/admin/img/logo.fw.png') }}" width="320" class="img-responsive" alt="">

                <p>Você está conectado! <br>
                Seja bem vindo <strong>{{auth()->user()->name}}</strong>
                </p>

            </div>
        </div>
    </div>
</section>
@endsection