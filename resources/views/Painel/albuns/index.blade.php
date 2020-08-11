@extends('painel.templates.template')

@section('content')

<!--Filters and actions-->
<div class="actions">
    <div class="container">
        <a class="add" href="{{url('/painel/album/cadastrar')}}">
            <i class="fa fa-plus-circle"></i>
        </a>

        <form class="form-search form form-inline" method="post" action="/painel/album/pesquisar">
            {{ csrf_field() }}
            <input type="text" name="pesquisar" placeholder="Pesquisar?" class="form-control">
            <input type="submit" value="Encontrar" class="btn btn-danger">
        </form>
    </div>
</div><!--Actions-->

<div class="clear"></div>

<div class="container">
    <h1 class="title">
        Listagem dos albúns 
    </h1>

    <table class="table table-hover">
        <tr>
            <th>Id</th>
            <th>Capa</th>
            <th>Nome</th>
            <th>Estilo</th>
            <th width="150px">Ações</th>
        </tr>

        @forelse( $albums as $album )
        <tr>
            <td>{{$album->id}}</td>
            <td> <img src="{{url("/assets/uploads/imgs/albuns/$album->imagem")}}" width="110" height="110"> </td>
            <td>{{$album->nome}}</td>
            <td>{{$album->estilo}}</td>
            <td>
                <a href="{{url("/painel/album/musicas/$album->id")}}" class="music">
                    <i class="fa fa-music"></i>
                </a>
                <a href="{{url("/painel/album/editar/$album->id")}}" class="edit">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a href="#" onclick='deletar("/painel/album/deletar/{{$album->id}}")' class="delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td> 
        </tr>
        @empty 
        <tr>
            <td colspan="90">Não Albúns Músicais Cadastrados</td>
        </tr>
        @endforelse
    </table>

    <nav>
        {{$albums->links()}}
    </nav>
</div>
@endsection