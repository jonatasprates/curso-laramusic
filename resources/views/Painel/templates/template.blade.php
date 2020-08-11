<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{$titulo or 'Painel LaraMusic'}}</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!--Fonts-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <!--CSS-->
        <link rel="stylesheet" href="{{url('assets/painel/css/laramusic-painel.css')}}">

        <!--Favicon-->
        <link rel="icon" type="image/png" href="{{url('assets/painel/imgs/favicon-laramusic.png')}}">
    </head>
    <body>
        <div class="menu">
            <ul class="menu col-md-12">
                <li class="col-md-2 text-center">
                    <a href="{{url('/painel/')}}">
                        <img src="{{url('assets/painel/imgs/laramusic-branca.png')}}" alt="LaraMuic" class="logo">
                    </a>
                </li>
                <li class="col-md-2 text-center">
                    <a href="{{url('/painel/estilos')}}">
                        <img src="{{url('assets/painel/imgs/estilos-laramusic.png')}}" alt="Estilos" class="img-menu">
                        <h1>Estilos</h1>
                    </a>
                </li>
                <li class="col-md-2 text-center">
                    <a href="{{url('/painel/albuns')}}">
                        <img src="{{url('assets/painel/imgs/albuns-laramusic.png')}}" alt="Albuns" class="img-menu">
                        <h1>Albuns</h1>
                    </a>
                </li>
                <li class="col-md-2 text-center">
                    <a href="{{url('/painel/musicas')}}">
                        <img src="{{url('assets/painel/imgs/music-laramusic.png')}}" alt="Musicas" class="img-menu">
                        <h1>Músicas</h1>
                    </a>
                </li>
                <li class="col-md-2 text-center">
                    <a href="{{url('/painel/users')}}">
                        <img src="{{url('assets/painel/imgs/perfil-laramusic.png')}}" alt="Meu Perfil" class="img-menu">
                        <h1>Usuários</h1>
                    </a>
                </li>
                <li class="col-md-2 text-center">
                    <a href="{{ url('/logout') }}">
                        <img src="{{url('assets/painel/imgs/sair-laramusic.png')}}" alt="Sair" class="img-menu">
                        <h1>Sair</h1>
                    </a>
                </li>
            </ul>
        </div><!--Menu-->

        <div class="clear"></div>

        @yield('content')

        <div class="clear"></div>

        <div class="footer actions">
            <div class="container text-center">
                <p class="footer">EspecializaTi - Todos os direitos reservados</p>
            </div>
        </div>


        <!--jQuery-->
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        
        <!-- Modal Delete -->
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirmação Deletar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="errors-msg-delete alert alert-danger" style="display: none;"></div>
                        <div class="success-msg-delete alert alert-success" style="display: none;"></div>

                        <p class="msg-delete">Deletar Informação?</p>

                        <input type="hidden" id="urlDeletar" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger btn-confirm-delete">Deletar</button>

                        <div class="preloader-delete" style="display: none;">
                            <img src="http://especializati.com.br/assets/portal/imgs/preloader.gif" title="Enviando..." alt="Enviando...">
                        </div>    
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

        <script>
            function deletar(urlDeletar){
                jQuery("#urlDeletar").val(urlDeletar);
                
                jQuery("#modalDelete").modal();
            }
            
            jQuery(".btn-confirm-delete").click(function(){
               //pega a url de deletar
               var urlDeletar = jQuery("#urlDeletar").val();
               
               jQuery.ajax({
                    url: urlDeletar,
                    method: 'GET',
                    beforeSend: preloaderDelete()
                }).done(function(data){
                    if( data == "1" ) {
                        jQuery(".errors-msg").hide();

                        jQuery(".success-msg-delete").html("Deletado com sucesso!");
                        jQuery(".success-msg-delete").show();

                        setTimeout("location.reload();", 1000);
                    } else {
                        jQuery(".errors-msg-delete").html(data);
                        jQuery(".errors-msg-delete").show();
                    }
                }).fail(function(){
                    alert('Falha ao enviar dados');
                }).complete(function(){
                    finalizaPreloaderDelete();
                });
            
            
                function preloaderDelete()
                {
                    jQuery(".preloader-delete").show();
                }

                function finalizaPreloaderDelete()
                {
                    jQuery(".preloader-delete").hide();
                }
               
            });
        </script>


    </body>
</html>