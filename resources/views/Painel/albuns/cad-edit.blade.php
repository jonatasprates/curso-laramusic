@extends('painel.templates.template')

@section('content')
<div class="container">
    <h1 class="title">
        Gestão de Albúm	
    </h1>
    
    @if( isset($errors) &&  count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach( $errors->all() as $error )
            {{ $error }} <br>
        @endforeach
    </div>
    @endif
    
    @if( isset($album) )
        <form class="form" method="post" action="/painel/album/editar/{{$album->id}}" enctype="multipart/form-data">
    @else
        <form class="form" method="post" action="/painel/album/cadastrar" enctype="multipart/form-data">
    @endif
    
        {{ csrf_field() }}
        
        <div class="form-group">
            <select name="id_estilo" class="form-control">
                <option value=""> Escolha  o Estilo </option>
                
                @foreach($estilos as $estilo)
                    <option value="{{$estilo->id}}"
                    @if( isset($album->id_estilo) && $album->id_estilo == $estilo->id )
                        selected
                    @endif
                    >{{$estilo->nome}}</option> 
                @endforeach
                
            </select>
        </div>
        
        <div class="form-group">
            <input type="text" name="nome" placeholder="Insira o Nome do Albúm" class="form-control" value="{{$album->nome or old('nome') }}">
        </div>
        <div class="form-group">
            <input type="file" name="imagem" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
        </div>
    </form>
</div>
@endsection