@extends('panel.includes.app',['activePage' => 'account.index'])

@section('title')
Contas
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
                        <li class="breadcrumb-item active">Contas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>
                            R$ {{number_format($pagas, 2, ',', '.')}}
                        </h3>
                        <p>Contas pagas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>
                            R$ {{number_format($receber, 2, ',', '.')}}
                        </h3>

                        <p>Contas a receber</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>


            <!-- ./col -->
        </div>
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
                            <h3 class="card-title">Lista de contas</h3>
                            <div class="card-tools">
                                <a href="#zerar" data-toggle="modal" class="btn btn-danger">
                                    <i class="nav-icon fas fa-trash-alt"></i> Excluir todos</a>

                                {{-- exluir todos --}}
                                <div class="modal fade" id="zerar" data-backdrop="static">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            {!! Form::open(['route'=>['account.zerar'], 'method'=>'get']) !!}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <h4>Deseja realmente deletar todos?</h4>
                                                        <button type="button" class="btn btn-green"
                                                            data-dismiss="modal">
                                                            CANCELAR
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">
                                                            DELETAR
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        </div><!-- /.modal-content -->
                                    </div>
                                </div>
                                {{-- end  --}}

                                <a href="#" data-toggle="modal" data-target="#add" class="btn btn-primary">
                                    <i class="nav-icon fa fa-plus"></i> Add nova</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>@if ($item->tipo == 1)
                                            Conta paga
                                            @else
                                            Conta a receber
                                            @endif</td>
                                        <td>{{$item->desc}}</td>
                                        <td>{{$item->valor}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                        <td>
                                            <a href="{{ route('account.delete', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-default" title="Deletar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhuma encontrada!!!</td>
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

<!-- Modal Clientes-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Nova
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.store') }}" class="navbar-form" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Tipo') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
                                    <select value="{{old('tipo') }}" name="tipo"
                                        class="form-control{{ $errors->has('tipo') ? ' has-danger' : '' }}" required>
                                        <option value="1">Contas a pagar</option>
                                        <option value="2">Contas a receber</option>
                                    </select>
                                    @if ($errors->has('tipo'))
                                    <span id="tipo-error" class="error text-danger">{{ $errors->first('tipo') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Descrição') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('desc') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}"
                                        name="desc" type="text" placeholder="Descrição" value="{{old('desc') }}"
                                        required />
                                    @if ($errors->has('desc'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('desc') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Valor') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('valor') ? ' has-danger' : '' }}">
                                    <input class="form-control money{{ $errors->has('valor') ? ' is-invalid' : '' }}"
                                        name="valor" type="text" placeholder="0,00" value="{{ old('valor') }}"
                                        required />
                                    @if ($errors->has('valor'))
                                    <span id="valor-error"
                                        class="error text-danger">{{ $errors->first('valor') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection