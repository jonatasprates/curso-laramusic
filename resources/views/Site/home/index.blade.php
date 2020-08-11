@extends('site.templates.template')

@section('content')
<section class="albuns">
    <div class="container">
        <h1 class="title">
            Últimos Albúns:
        </h1>
        <div class="list-albuns col-md-12">
            @forelse($albuns as $album)
            <article class="col-md-3 albun">
                <a href="/album/{{$album->id}}">
                    <div class="image-album">
                        <img src="{{url("assets/uploads/imgs/albuns/{$album->imagem}")}}" alt="{{$album->nome}}" class="img-albun">

                        <div class="hover-img-album">
                            <i class="fa fa-headphones"></i>
                        </div>
                    </div>
                    <h1 class="title-albun">{{$album->nome}}</h1>
                </a>
            </article>
            @empty
            <div class="col-md-12">
                <p>Não existem Albúns cadastrados!</p>
            </div>
            @endforelse
        </div><!--End list-albuns-->
    </div><!--End Container-->
</section><!--End Abuns-->

<div class="clear"></div>
<hr class="hr">

<section class="estilos">
    <div class="container">
        <h1 class="title">Estilos:</h1>

        <div class="estiulos-mu col-md-12">
            <div class="col-md-3">
                @forelse($estilos as $estilo)
                <a href="{{url("/estilo/{$estilo->id}")}}" class="estilo">
                    {{$estilo->nome}}
                </a>
                @empty
                <p>Não exitem Estilos cadastrados!</p>
                @endforelse
            </div>

        </div><!--end estiulos-mu-->
    </div><!--End Container-->
</section><!--End estilos-->
@endsection