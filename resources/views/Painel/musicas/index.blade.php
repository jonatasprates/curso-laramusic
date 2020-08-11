@extends('painel.templates.template')

@section('content')

<!--Filters and actions-->
<div class="actions">
    <div class="container">
        <a class="add" href="{{url('/painel/musica/cadastrar')}}">
            <i class="fa fa-plus-circle"></i>
        </a>

        <form class="form-search form form-inline" method="post" action="/painel/musica/pesquisar">
            {{ csrf_field() }}
            <input type="text" name="pesquisar" placeholder="Pesquisar?" class="form-control">
            <input type="submit" value="Encontrar" class="btn btn-danger">
        </form>
    </div>
</div><!--Actions-->

<div class="clear"></div>

<div class="container">
    <h1 class="title">
        Listagem das musicais
    </h1>

    <table class="table table-hover">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th width="100px">Ações</th>
        </tr>

        @forelse( $musicas as $musica )
        <tr>
            <td>{{$musica->id}}</td>
            <td>{{$musica->nome}}</td>
            <td>
                <a href="{{url("/painel/musica/editar/$musica->id")}}" class="edit">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a href="#" onclick='deletar("/painel/musica/deletar/{{$musica->id}}")' class="delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td> 
        </tr>
        @empty 
        <tr>
            <td colspan="90">Não Existem Músicais Cadastradas</td>
        </tr>
        @endforelse
    </table>

    <nav>
        {{$musicas->links()}}
    </nav>
</div>
@endsection