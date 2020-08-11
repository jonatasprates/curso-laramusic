@extends('auth.templates.template')

<!-- Main Content -->
@section('content-form')


@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<form class="login form" role="form" method="POST" action="{{ url('/password/email') }}">
    {{ csrf_field() }}

    @if ($errors->has('email'))
    <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" placeholder="Informe o seu e-mail" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-login">
            <i class="fa fa-btn fa-envelope"></i> Enviar E-mail de Recuperação
        </button>
    </div>
</form>
@endsection
