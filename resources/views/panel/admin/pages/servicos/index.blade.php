@extends('panel.includes.app',['activePage' => 'admin.servicos.index'])

@section('title')
Servicos
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
                        <li class="breadcrumb-item active">Serviços</li>
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
                <div class="col-md-12">
                    @include('panel.includes.alerts')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Serviços</h3>
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
                                        <th>descrição</th>
                                        <th>Valor</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->desc}}</td>
                                        <td>R$ {{$item->valor}}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#editar{{$item->id}}"
                                                class="btn btn-xs btn-default" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- Modal Serviços-->
                                            <div class="modal fade" id="editar{{$item->id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="editar{{$item->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar
                                                                serviço</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('admin.servico.update', ['id'=>$item->id]) }}"
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
                                                                            class="col-sm-3 col-form-label">{{ __('Descrição') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div
                                                                                class="form-group{{ $errors->has('desc') ? ' has-danger' : '' }}">
                                                                                <input
                                                                                    class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}"
                                                                                    name="desc" type="text"
                                                                                    placeholder="Descreva o tipo de serviço"
                                                                                    value="{{$item->desc, old('desc') }}" />
                                                                                @if ($errors->has('desc'))
                                                                                <span id="email-error"
                                                                                    class="error text-danger">{{ $errors->first('desc') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">{{ __('Valor') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div
                                                                                class="form-group{{ $errors->has('valor') ? ' has-danger' : '' }}">
                                                                                <input
                                                                                    class="form-control money2{{ $errors->has('valor') ? ' is-invalid' : '' }}"
                                                                                    name="valor" type="text"
                                                                                    placeholder="00"
                                                                                    value="{{ $item->valor, old('valor') }}"
                                                                                    required />
                                                                                @if ($errors->has('valor'))
                                                                                <span id="email-error"
                                                                                    class="error text-danger">{{ $errors->first('valor') }}</span>
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
                                            <a href="{{ route('admin.servico.delete', ['id'=>$item->id]) }}"
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
                <h5 class="modal-title" id="exampleModalLabel">Novo
                    cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.servico.store') }}" class="navbar-form" method="post"
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
                            <label class="col-sm-3 col-form-label">{{ __('Descrição') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('desc') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}"
                                        name="desc" type="text" placeholder="Descreva o tipo de serviço"
                                        value="{{old('desc') }}" />
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
                                    <input class="form-control money2{{ $errors->has('valor') ? ' is-invalid' : '' }}"
                                        name="valor" type="text" placeholder="00" value="{{ old('valor') }}" required />
                                    @if ($errors->has('valor'))
                                    <span id="email-error"
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