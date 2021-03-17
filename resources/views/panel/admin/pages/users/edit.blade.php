@extends('panel.includes.app', ['activePage' => 'admin.user.edit', 'titlePage' => __('Editar usuário')])
@section('title')
Editar usuário
@endsection
@section('content')
<section class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Editar usuário</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="post" action="{{ route('admin.user.update', ['id'=>$data->id]) }}"
                            autocomplete="off" class="form-horizontal">
                            @csrf
                            @method('put')

                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Editar dados') }}</h4>
                            </div>
                            <div class="card-body ">
                                @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Nome') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                name="name" id="input-name" type="text" placeholder="{{ __('Name') }}"
                                                value="{{ old('name', $data->name) }}" required="true"
                                                aria-required="true" />
                                            @if ($errors->has('name'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('E-mail') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" id="input-email" type="email"
                                                placeholder="{{ __('Email') }}" value="{{ $data->email, old('email') }}"
                                                required disabled />
                                            @if ($errors->has('email'))
                                            <span id="email-error" class="error text-danger"
                                                for="input-email">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Nível') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            {!! Form::select('role', [
                                                'admin'=>'Administrador', 
                                                'operador'=>'Operador',
                                                'caixa' => 'Operador caixa'
                                            ],
                                            $data->role, ['class'=>'form-control', $errors->has('email') ? ' is-invalid'
                                            : '']) !!}

                                            @if ($errors->has('role'))
                                            <span id="role-error" class="error text-danger"
                                                for="input-role">{{ $errors->first('role') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="post" action="{{ route('admin.user.password', ['id'=>$data->id]) }}"
                        class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Alterar senha') }}</h4>
                        </div>
                        <div class="card-body ">
                            @if (session('status_password'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>{{ session('status_password') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <label class="col-sm-2 col-form-label"
                                    for="input-current-password">{{ __('Senha atual') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                        <input
                                            class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                            input type="password" name="old_password" id="input-current-password"
                                            placeholder="{{ __('Senha atual') }}" value="" required />
                                        @if ($errors->has('old_password'))
                                        <span id="name-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('old_password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"
                                    for="input-password">{{ __('Nova senha') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" id="input-password" type="password"
                                            placeholder="{{ __('Nova senha') }}" value="" required />
                                        @if ($errors->has('password'))
                                        <span id="password-error" class="error text-danger"
                                            for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"
                                    for="input-password-confirmation">{{ __('Confirmar senha') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="password_confirmation"
                                            id="input-password-confirmation" type="password"
                                            placeholder="{{ __('Confirmar senha') }}" value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Alterar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection