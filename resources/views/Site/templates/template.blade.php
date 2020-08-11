<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{$title or 'LaraMusic'}}</title>

        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="{{url('assets/all/css/bootstrap.css')}}">

        <!--Fonts Icons CSS-->
        <link rel="stylesheet" href="{{url('assets/all/css/font-awesome.min.css')}}">

        <!--CSS-->
        <link rel="stylesheet" href="{{url('assets/site/css/laramusic.css')}}">

        <!--RESETS-->
        <link rel="stylesheet" href="{{url('assets/site/css/resets.css')}}">

        <!--Favicon-->
        <link rel="icon" type="image/png" href="{{url('assets/site/imgs/favicon-laramusic.png')}}">

        <!--jQuery-->
        <script src="{{url('assets/all/js/jquery-2.2.0.min.js')}}"></script>

        <!--Inicio do jPlayer-->
        <link href="{{url('assets/all/dist/skin/blue.monday/css/jplayer.blue.monday.min.css')}}" rel="stylesheet">
        <script src="{{url('assets/all/dist/jplayer/jquery.jplayer.min.js')}}"></script>
        <script src="{{url('assets/all/dist/add-on/jplayer.playlist.min.js')}}"></script>
        
        @stack('scripts-header')
    </head>
    <body>

        <header class="header">
            <div class="container">
                <div class="col-md-3">
                    <a href="{{url('/')}}">
                        <img src="{{url('assets/site/imgs/laramusic.png')}}" alt="LaraMusic" title="LaraMusic" class="img-logo">
                    </a>
                </div>

                <div class="col-md-7">
                    <form class="form-search" method="POST" action="/album/pesquisar">
                        {{csrf_field()}}
                        <input type="text" name="pesquisa" placeholder="Pesquisar Albúns">
                        <button class="btn-search"><i class="fa fa-search"></i></button>
                    </form>
                </div>

                <div class="col-md-2">
                    <a href="{{url('/login')}}" class="login">Entrar</a>
                </div>
            </div><!--End Container-->
        </header><!--End Header-->

        <div class="clear"></div>

        <hr class="hr">

            @yield('content')

        <div class="clear"></div>


        <footer class="footer">
            <div class="container text-center">
                <p class="text-footer">CopyRight © EspecializaTI - Todos os direitos reservados <?= date('Y') ?> <br>
                    CNPJ: 23.882.706/0001-20 - contato@especializati.com.br</p>

                <div class="social">
                    <a href="">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="">
                        <i class="fa fa-twitter"></i>
                    </a>
                </div>
            </div><!--End Container-->
        </footer><!--End Footer-->



        <!--Bootstrap js-->
        <script src="{{url('assets/all/js/bootstrap.min.js')}}"></script>
        
        @stack('scripts-footer')
    </body>
</html>




