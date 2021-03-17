@extends('panel.includes.app',['activePage' => 'agenda.index'])

@section('title')
Agenda
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
                        <li class="breadcrumb-item active">Agenda</li>
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
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 10px">
                            <form action="{{ route('agenda.search') }}" method="get">
                                <div class="row">
                                    <div class="col-2">
                                        <input type="date" name="date-start" class="form-control float-right"
                                            placeholder="00/00/0000" required>
                                    </div>
                                    <div class="col-2">
                                        <input type="date" name="date-end" class="form-control float-right"
                                            placeholder="00/00/0000" required>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Agendamentos</h3>

                            <div class="card-tools">

                                <a href="#" data-toggle="modal" data-target="#add" class="btn btn-primary">
                                    <i class="nav-icon fa fa-plus"></i> Add novo</a>


                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Serviço</th>
                                        <th>Data</th>
                                        <th>Horório</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->client->name ?? ''}}</td>
                                        <td>{{$item->servico}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->date))}}</td>
                                        <td>{{$item->hora}}</td>
                                        <td>

                                            @if ($item->date <= date('Y-m-d') && $item->hora >= strtotime('H:i') &&
                                                $item->status != 'Compareceu')
                                                <span style="color: orangered">Não compareceu</span>
                                                @else
                                                {{$item->status}}
                                                @endif
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#update{{$item->id}}"
                                                class="btn btn-xs btn-default" title="Alterar status">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- Modal Serviços-->
                                            <div class="modal fade" id="update{{$item->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="update{{$item->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="exampleModalLabel">Alterar
                                                                status
                                                                agendamento</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('agenda.update', ['id'=>$item->id]) }}"
                                                                class="navbar-form" method="post">
                                                                @csrf
                                                                @method('post')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">{{ __('Status') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div
                                                                                class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                                                                <select name="status"
                                                                                    class="form-control">
                                                                                    <option value="Em espera">Em espera
                                                                                    </option>
                                                                                    <option value="Compareceu">
                                                                                        Compareceu
                                                                                    </option>
                                                                                </select>
                                                                                @if ($errors->has('name'))
                                                                                <span id="email-error"
                                                                                    class="error text-danger">{{ $errors->first('status') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Alterar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('agenda.delete', ['id'=>$item->id]) }}"
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

<!-- Modal Serviços-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Novo agendamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agenda.store') }}" class="navbar-form" method="post">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Nome') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <select name="client_id" class="form-control">
                                        @foreach ($clients as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('name'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Serviço') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('servico') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('servico') ? ' is-invalid' : '' }}"
                                        name="servico" type="text" placeholder="Descreva o tipo de serviço"
                                        value="{{old('servico') }}" />
                                    @if ($errors->has('servico'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('servico') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Data') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                        name="date" type="date" placeholder="00/00/0000" value="{{ old('date') }}"
                                        required />
                                    @if ($errors->has('date'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Horário') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('hora') ? ' has-danger' : '' }}">
                                    <input class="form-control {{ $errors->has('hora') ? ' is-invalid' : '' }}"
                                        name="hora" type="time" placeholder="00:00" value="{{ old('hora') }}"
                                        required />
                                    @if ($errors->has('hora'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('hora') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agendar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection