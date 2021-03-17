<div class="row">
    <label class="col-sm-3 col-form-label">{{ __('Produto') }}</label>
    <div class="col-sm-9">
        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
            <input type="text" name="name" value="{{$data->name ?? old('name') }}"
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
            <input class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" name="desc" type="text"
                placeholder="" value="{{$data->desc ?? old('desc') }}" />
            @if ($errors->has('desc'))
            <span id="email-error" class="error text-danger">{{ $errors->first('desc') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <label class="col-sm-3 col-form-label">{{ __('Qtd estoque') }}</label>
    <div class="col-sm-9">
        <div class="form-group{{ $errors->has('qtd') ? ' has-danger' : '' }}">
            <input class="form-control{{ $errors->has('estoque') ? ' is-invalid' : '' }}" name="qtd" type="number"
                placeholder="0" value="{{$data->qtd ?? old('qtd') }}" />
            @if ($errors->has('qtd'))
            <span id="email-error" class="error text-danger">{{ $errors->first('qtd') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <label class="col-sm-3 col-form-label">{{ __('Valor') }}</label>
    <div class="col-sm-9">
        <div class="form-group{{ $errors->has('valor') ? ' has-danger' : '' }}">
            <input class="form-control money2{{ $errors->has('valor') ? ' is-invalid' : '' }}" name="valor" type="text"
                placeholder="00" value="{{$data->valor ?? old('valor') }}" required />
            @if ($errors->has('valor'))
            <span id="email-error" class="error text-danger">{{ $errors->first('valor') }}</span>
            @endif
        </div>
    </div>
</div>