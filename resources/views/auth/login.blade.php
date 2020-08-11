@extends('auth.templates.template')

@section('content-form')

<form class="login form" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif

        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

        <input id="email" type="email" class="form-control"  placeholder="Informe o seu e-mail" name="email" value="{{ old('email') }}">

    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

        <input id="password" type="password" placeholder="Informe a sua senha" class="form-control" name="password">

    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-login">
            <i class="fa fa-btn fa-sign-in"></i> Entrar
        </button>
    </div>
    <div class="form-group text-right">
        <a href="{{ url('/password/reset') }}" class="recuperar">
            Recuperar Senha?
        </a>
    </div>
</form>

@endsection