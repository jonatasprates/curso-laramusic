@extends('painel.templates.template')

@section('content')
<div class="container">
    <h1 class="title">
        Gestão de Estilo	
    </h1>
    
    @if( isset($errors) &&  count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach( $errors->all() as $error )
            {{ $error }} <br>
        @endforeach
    </div>
    @endif
    
    @if( isset($estilo) )
        <form class="form" method="post" action="/painel/estilo/editar/{{$estilo->id}}">
    @else
        <form class="form" method="post" action="/painel/estilo/cadastrar">
    @endif
    
        {{ csrf_field() }}
        
        <div class="form-group">
            <input type="text" name="nome" placeholder="Insira o Nome do Estilo" class="form-control" value="{{$estilo->nome or old('nome') }}">
        </div>
        <div class="form-group">
            <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
        </div>
    </form>
</div>
@endsection