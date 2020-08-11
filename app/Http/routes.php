<?php

//Gestão do Painel
Route::group(['prefix' => 'painel', 'middleware' => ['auth'], 'web'], function($route){
    
    
    //Rota estilo do Painel
    $route->get('estilos', 'Painel\EstiloController@index');
    $route->get('estilo/cadastrar', 'Painel\EstiloController@cadastrar');
    $route->post('estilo/cadastrar', 'Painel\EstiloController@cadastrarEstilo');
    $route->get('estilo/editar/{id}', 'Painel\EstiloController@editar');
    $route->post('estilo/editar/{id}', 'Painel\EstiloController@editarEstilo');
    $route->get('estilo/deletar/{id}', 'Painel\EstiloController@deletar');
    $route->post('estilo/pesquisar', 'Painel\EstiloController@pesquisar');
    
    //Rotas albúm do Painel
    $route->get('albuns', 'Painel\AlbunController@index');
    $route->get('album/cadastrar', 'Painel\AlbunController@cadastrar');
    $route->post('album/cadastrar', 'Painel\AlbunController@cadastrarAlbum');
    $route->get('album/editar/{id}', 'Painel\AlbunController@editar');
    $route->post('album/editar/{id}', 'Painel\AlbunController@editarAlbum');
    $route->get('album/deletar/{id}', 'Painel\AlbunController@deletar');
    $route->post('album/pesquisar', 'Painel\AlbunController@pesquisar');
    
    //Rotas música do Painel
    $route->get('musicas', 'Painel\MusicaController@index');
    $route->get('musica/cadastrar', 'Painel\MusicaController@cadastrar');
    $route->post('musica/cadastrar', 'Painel\MusicaController@cadastrarMusica');
    $route->get('musica/editar/{id}', 'Painel\MusicaController@editar');
    $route->post('musica/editar/{id}', 'Painel\MusicaController@editarMusica');
    $route->get('musica/deletar/{id}', 'Painel\MusicaController@deletar');
    $route->post('musica/pesquisar', 'Painel\MusicaController@pesquisar');
    
    //Rotas user do Painel
    $route->get('users', 'Painel\UserController@index');
    $route->get('user/cadastrar', 'Painel\UserController@cadastrar');
    $route->post('user/cadastrar', 'Painel\UserController@cadastrarUser');
    $route->get('user/editar/{id}', 'Painel\UserController@editar');
    $route->post('user/editar/{id}', 'Painel\UserController@editarUser');
    $route->get('user/deletar/{id}', 'Painel\UserController@deletar');
    $route->post('user/pesquisar', 'Painel\UserController@pesquisar');
    
    // Rota Albuns <=> Músicas
    $route->get('album/musicas/{id}', 'Painel\AlbunController@musicas');
    $route->get('album/{id}/musicas/cadastrar', 'Painel\AlbunController@musicasCadastrar');
    $route->post('album/{id}/musicas/cadastrar', 'Painel\AlbunController@musicasCadastrarGo');
    $route->get('album/{idAlbum}/musica/deletar/{idMusica}', 'Painel\AlbunController@deletarMusicaAlbum');
    $route->post('album/musicas/{id}', 'Painel\AlbunController@musicaPesquisar');
    $route->post('album/{id}/musicas/pesquisar', 'Painel\AlbunController@pesquisarMusicaAdd');
    
    //Rota inical do Painel
    $route->get('/', 'Painel\PainelController@index');
});


//Rota de autenticação do usuário
Route::group(['middleware' => [], 'web'], function(){

// Authentication routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::get('password/reset', 'Auth\PasswordController@reset');
    
});

//Listagem dos albúns de um determinado estilo musical
Route::get('/estilo/{id}', 'Site\SiteController@albunsEstilo');

//Mostra as músicas do albúm
Route::get('/album/{id}', 'Site\SiteController@musicasAlbum');

//Filtra os albuns
Route::post('/album/pesquisar', 'Site\SiteController@albumPesquisar');

//Home Page do LaraMusic
Route::get('/', 'Site\SiteController@index');


