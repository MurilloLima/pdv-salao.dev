@extends('panel.includes.app',['activePage' => 'admin.users.index'])

@section('title')
Usuários
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
                        <li class="breadcrumb-item active">Usuários</li>
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
                            <h3 class="card-title">Lista de usuários</h3>
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
                                        <th>E-mail</th>
                                        <th>Nível</th>
                                        <th>Cadastrado em</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->role}}</td>
                                        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                        <td>
                                            <a href="{{ route('admin.user.edit', ['id'=>$item->id]) }}"
                                                class="btn btn-xs btn-default" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.user.delete', ['id'=>$item->id]) }}"
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
                <form action="{{ route('admin.user.store') }}" class="navbar-form" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Nome') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input type="text" name="name"
                                        class="form-control{{ $errors->has('name') ? ' has-danger' : '' }}" required>
                                    @if ($errors->has('name'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('E-mail') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" type="email" placeholder="E-mail" value="{{old('email') }}"
                                        required />
                                    @if ($errors->has('email'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('fone') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" type="password" placeholder="" value="{{ old('password') }}"
                                        required autocomplete="new-password" />
                                    @if ($errors->has('password'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Password Confirm') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                                    <input
                                        class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                        name="password_confirmation" type="password" placeholder=""
                                        value="{{ old('password_confirmation') }}" required
                                        autocomplete="new-password" />
                                    @if ($errors->has('password_confirmation'))
                                    <span id="email-error"
                                        class="error text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Nível') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                    <select name="role" required
                                        class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
                                        <option value="">Escolha...</option>
                                        <option value="admin">Administrador</option>
                                        <option value="caixa">Operador caixa</option>
                                        <option value="operador">Operador</option>
                                    </select>
                                    @if ($errors->has('role'))
                                    <span id="email-error" class="error text-danger">{{ $errors->first('role') }}</span>
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