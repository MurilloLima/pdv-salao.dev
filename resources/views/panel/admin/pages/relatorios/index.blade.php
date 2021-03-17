@extends('panel.includes.app',['activePage' => 'relatorios.index'])

@section('title')
Relatórios
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
                        <li class="breadcrumb-item active">Relatórios</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{count($tickets)}}</h3>

                            <p>Tickets em aberto</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-th"></i>
                        </div>
                        <a href="{{ route('caixa.index') }}" class="small-box-footer">Visualizar <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{count($servicos)}}</h3>

                            <p>Serviços</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-align-justify"></i>
                        </div>
                        <a href="{{ route('servicos.index') }}" class="small-box-footer">Visualizar <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{count($clientes)}}</h3>

                            <p>Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('clientes.index') }}" class="small-box-footer">Visualizar <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{count($users)}}</h3>

                            <p>Usuários do App</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">Visualizar <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div style="margin-top: 10px">
                    <a href="#" data-toggle="modal" data-target="#dayRelatorio" class="btn btn-app"><i class="fas fa-chart-pie"></i>
                        Relatório por dia
                    </a>
                    <a href="#" data-toggle="modal" data-target="#monthRelatorio" class="btn btn-app"><i class="fas fa-chart-pie"></i>
                        Relatório por mês
                    </a>
                    <a href="#" data-toggle="modal" data-target="#yearRelatorio" class="btn btn-app"><i class="fas fa-chart-pie"></i>
                        Relatório por ano
                    </a>
                    <a href="#" data-toggle="modal" data-target="#RelatorioSearch" class="btn btn-app"><i class="fas fa-chart-pie"></i>
                        Relatório personalizado
                    </a>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    {{-- content --}}
    {{-- end content --}}
</section>

<!-- Modal novo relatorio new-->


<!-- Modal novo relatorio day-->
<div class="modal fade" id="dayRelatorio" tabindex="-1" role="dialog" aria-labelledby="dayRelatorio"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Novo relatório
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('relatorios.day') }}" class="navbar-form" method="get">
                    @method('get')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Data') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('day') ? ' has-danger' : '' }}">
                                    <input type="date" name="day" class="form-control" placeholder="DD/MM/YYYY">
                                    @if ($errors->has('day'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('day') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Gerar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="monthRelatorio" tabindex="-1" role="dialog" aria-labelledby="monthRelatorio"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Novo relatório
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('relatorios.month') }}" class="navbar-form" method="get">
                    @method('get')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Mês') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('month') ? ' has-danger' : '' }}">
                                    <input type="number" min="1" max="12" name="month" class="form-control">
                                    @if ($errors->has('month'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('month') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Gerar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="yearRelatorio" tabindex="-1" role="dialog" aria-labelledby="yearRelatorio"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Novo relatório
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('relatorios.year') }}" class="navbar-form" method="get">
                    @method('get')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Ano') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                                    <input type="text" name="year" class="form-control year">
                                    @if ($errors->has('year'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('year') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Gerar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="RelatorioSearch" tabindex="-1" role="dialog" aria-labelledby="RelatorioSearch"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Novo relatório
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('relatorios.personalizado') }}" class="navbar-form" method="get">
                    @method('get')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Início') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('date1') ? ' has-danger' : '' }}">
                                    <input type="date" name="date1" class="form-control">
                                    @if ($errors->has('date1'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('date1') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Fim') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('date2') ? ' has-danger' : '' }}">
                                    <input type="date" name="date2" class="form-control">
                                    @if ($errors->has('date2'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('date2') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Gerar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection