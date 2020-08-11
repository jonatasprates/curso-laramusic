@extends('painel.templates.template')

@section('content')
<div class="container">
    <h1 class="title">
        Gestão de Usuários	
    </h1>
    
    @if( isset($errors) &&  count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach( $errors->all() as $error )
            {{ $error }} <br>
        @endforeach
    </div>
    @endif
    
    @if( isset($user) )
        <form class="form" method="post" action="/painel/user/editar/{{$user->id}}">
    @else
        <form class="form" method="post" action="/painel/user/cadastrar">
    @endif
    
        {{ csrf_field() }}
        
        <div class="form-group">
            <input type="text" name="name" placeholder="Insira o Nome do Usuário" class="form-control" value="{{$user->name or old('name') }}">
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Insira o E-mail do Usuário" class="form-control" value="{{$user->email or old('email') }}">
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Insira a senha do Usuário" class="form-control" value="{{old('password') }}">
        </div>
        <div class="form-group">
            <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
        </div>
    </form>
</div>
@endsection