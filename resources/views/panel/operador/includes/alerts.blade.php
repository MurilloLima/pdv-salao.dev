@if ($errors->any())
<div class="alert alert-warning">
    @foreach ($errors->all() as $error)
    <span>{{$error}}</span>
    @endforeach
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    <span>{{session('success')}}</span>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    <span>{{session('error')}}</span>
</div>
@endif