@extends('panel.includes.app',['activePage' => 'clientes.index'])

@section('title')
Clientes
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
                        <li class="breadcrumb-item active">Clientes</li>
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
                            <h3 class="card-title">Lista de clientes</h3>
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
                                        <th>Foto</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>CPF</th>
                                        <th>Cliente desde</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>
                                            <div class="image">
                                                <img class="img-circle elevation-2" width="34" height="34"
                                                    src="/upload/avatar/{{$item->avatar}}" alt="">
                                            </div>
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->fone}}</td>
                                        <td>{{$item->cpf}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#ticket{{$item->id}}"
                                                class="btn btn-xs btn-default" title="Abrir novo ticket">Abrir ticket
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <!-- Modal ticket-->
                                            <div class="modal fade" id="ticket{{$item->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="ticket{{$item->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="exampleModalLabel">Abrir ticket
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('ticket.store', ['id'=>$item->id]) }}"
                                                                class="navbar-form" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('post')
                                                                <div class="modal-body">
                                                                    O novo ticket será gerado automaticamente: <br>
                                                                    <strong style="text-transform: uppercase">
                                                                        [{{$item->name}}]</strong>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Abrir</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="#" data-toggle="modal" data-target="#editar{{$item->id}}"
                                                class="btn btn-xs btn-default" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Modal Serviços-->
                                            <div class="modal fade" id="editar{{$item->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="editar{{$item->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar
                                                                cliente</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('cliente.update', ['id'=>$item->id]) }}"
                                                                class="navbar-form" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('post')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">{{ __('Nome') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div
                                                                                class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                                                <input type="text" name="name"
                                                                                    value="{{$item->name, old('name') }}"
                                                                                    class="form-control{{ $errors->has('name') ? ' has-danger' : '' }}"
                                                                                    required>
                                                                                @if ($errors->has('name'))
                                                                                <span id="email-error"
                                                                                    class="error text-danger">{{ $errors->first('name') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">{{ __('CPF') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div
                                                                                class="form-group{{ $errors->has('cpf') ? ' has-danger' : '' }}">
                                                                                <input
                                                                                    class="form-control cpf{{ $errors->has('cpf') ? ' is-invalid' : '' }}"
                                                                                    name="cpf" type="text"
                                                                                    placeholder="000.000.000-00"
                                                                                    value="{{$item->cpf, old('cpf') }}" />
                                                                                @if ($errors->has('cpf'))
                                                                                <span id="email-error"
                                                                                    class="error text-danger">{{ $errors->first('cpf') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">{{ __('Telefone') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div
                                                                                class="form-group{{ $errors->has('fone') ? ' has-danger' : '' }}">
                                                                                <input
                                                                                    class="form-control phone_with_ddd{{ $errors->has('fone') ? ' is-invalid' : '' }}"
                                                                                    name="fone" type="text"
                                                                                    placeholder="00"
                                                                                    value="{{ $item->fone, old('fone') }}"
                                                                                    required />
                                                                                @if ($errors->has('fone'))
                                                                                <span id="email-error"
                                                                                    class="error text-danger">{{ $errors->first('fone') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">{{ __('Data nasc.') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div
                                                                                class="form-group{{ $errors->has('date_nasc') ? ' has-danger' : '' }}">
                                                                                <input
                                                                                    class="form-control{{ $errors->has('date_nasc') ? ' is-invalid' : '' }}"
                                                                                    name="date_nasc" type="text"
                                                                                    placeholder="00"
                                                                                    value="{{ $item->date_nasc, old('date_nasc') }}"
                                                                                    required />
                                                                                @if ($errors->has('date_nasc'))
                                                                                <span id="email-error"
                                                                                    class="error text-danger">{{ $errors->first('date_nasc') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">{{ __('Foto') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div
                                                                                class="form-group{{ $errors->has('avatar') ? ' has-danger' : '' }}">
                                                                                <input
                                                                                    class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}"
                                                                                    name="avatar" type="file"
                                                                                    value="{{ $item->avatar, old('avatar') }}" />
                                                                                @if ($errors->has('avatar'))
                                                                                <span id="email-error"
                                                                                    class="error text-danger">{{ $errors->first('avatar') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Atualizar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="{{ route('cliente.delete', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-default" title="Deletar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhum cliente encontrado!!!</td>
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
                <h5 class="modal-title" id="exampleModalLabel">Novo
                    cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cliente.store') }}" class="navbar-form" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Nome') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input type="text" name="name" value="{{old('name') }}"
                                        class="form-control{{ $errors->has('name') ? ' has-danger' : '' }}" required>
                                    @if ($errors->has('name'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('CPF') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('cpf') ? ' has-danger' : '' }}">
                                    <input class="form-control cpf{{ $errors->has('cpf') ? ' is-invalid' : '' }}"
                                        name="cpf" type="text" placeholder="000.000.000-00" value="{{old('cpf') }}" />
                                    @if ($errors->has('cpf'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('cpf') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Telefone') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('fone') ? ' has-danger' : '' }}">
                                    <input
                                        class="form-control phone_with_ddd{{ $errors->has('fone') ? ' is-invalid' : '' }}"
                                        name="fone" type="text" placeholder="(00) 0000-0000" value="{{ old('fone') }}"
                                        required />
                                    @if ($errors->has('fone'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('fone') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Data nasc.') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('date_nasc') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('date_nasc') ? ' is-invalid' : '' }}"
                                        name="date_nasc" type="date" placeholder="00/00/0000"
                                        value="{{ old('date_nasc') }}" required />
                                    @if ($errors->has('date_nasc'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('date_nasc') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Foto') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('avatar') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}"
                                        name="avatar" type="file" value="{{ old('avatar') }}" />
                                    @if ($errors->has('avatar'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('avatar') }}</span>
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