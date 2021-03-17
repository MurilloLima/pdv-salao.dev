@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-warning">
    <span>{{$error}}</span>
</div>
@endforeach
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