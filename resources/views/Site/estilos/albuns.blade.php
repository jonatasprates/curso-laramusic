@extends('site.templates.template')

@section('content')
<section class="estilo-selected">
    <div class="container">
        <h1 class="title">{{$estilo->nome}}</h1>
        <div class="list-albuns col-md-12">
            @forelse($albuns as $album)
            <article class="col-md-3 albun">
                <a href="album">
                    <div class="image-album">
                        <img src="{{url("assets/uploads/imgs/albuns/{$album->imagem}")}}" alt="{{$album->nome}}" class="img-albun">
                        
                        <div class="hover-img-album">
                            <li class="fa fa-headphones"></li>
                        </div>
                    </div>
                    <h1 class="title-albun">{{$album->nome}}</h1>
                </a>
            </article>
            @empty
            <div class="col-md-12">
                <p>Não existem albúns para este estilo músical</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection