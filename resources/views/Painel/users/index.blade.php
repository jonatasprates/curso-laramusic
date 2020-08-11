@extends('painel.templates.template')

@section('content')

<!--Filters and actions-->
<div class="actions">
    <div class="container">
        <a class="add" href="{{url('/painel/user/cadastrar')}}">
            <i class="fa fa-plus-circle"></i>
        </a>

        <form class="form-search form form-inline" method="post" action="/painel/user/pesquisar">
            {{ csrf_field() }}
            <input type="text" name="pesquisar" placeholder="Pesquisar?" class="form-control">
            <input type="submit" value="Encontrar" class="btn btn-danger">
        </form>
    </div>
</div><!--Actions-->

<div class="clear"></div>

<div class="container">
    <h1 class="title">
        Listagem dos usuários
    </h1>

    <table class="table table-hover">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th width="100px">Ações</th>
        </tr>

        @forelse( $users as $user )
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <a href="{{url("/painel/user/editar/$user->id")}}" class="edit">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a href="#" onclick='deletar("/painel/user/deletar/{{$user->id}}")' class="delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td> 
        </tr>
        @empty 
        <tr>
            <td colspan="90">Não Existem usuários Cadastrados</td>
        </tr>
        @endforelse
    </table>

    <nav>
        {{$users->links()}}
    </nav>
</div>
@endsection