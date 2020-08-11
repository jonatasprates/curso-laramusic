@extends('painel.templates.template')

@section('content')

<!--Filters and actions-->
<div class="actions">
    <div class="container">
        <a class="add" href="{{url("/painel/album/{$album->id}/musicas/cadastrar")}}">
            <i class="fa fa-plus-circle"></i>
        </a>

        <form class="form-search form form-inline" method="post" action="/painel/album/musicas/{{$album->id}}">
            {{ csrf_field() }}
            <input type="text" name="pesquisar" placeholder="Pesquisar?" class="form-control">
            <input type="submit" value="Encontrar" class="btn btn-danger">
        </form>
    </div>
</div><!--Actions-->

<div class="clear"></div>

<div class="container">
    <h1 class="title">
        Listagem das Músicas do Albúm: <strong> {{$album->nome}} </strong>
    </h1>

    <table class="table table-hover">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th width="150px">Ações</th>
        </tr>

        @forelse( $musicas as $musica )
        <tr>
            <td>{{$musica->id}}</td>
            <td>{{$musica->nome}}</td>
            <td>
            <!--   <a href="#" onclick='deletar("/painel/album/{{$album->id}}/musica/deletar/{{$musica->id}}")' class="delete">
                    <i class="fa fa-trash"></i>
                </a>  -->
                <a href="/painel/album/{{$album->id}}/musica/deletar/{{$musica->id}}"  class="delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td> 
        </tr>
        @empty 
        <tr>
            <td colspan="90">Não existem Músicas neste Albúm </td>
        </tr>
        @endforelse
    </table>

</div>

@endsection