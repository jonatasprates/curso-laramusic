<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Painel\Album;
use App\Models\Painel\Estilo;
use App\Models\Painel\Musica;

class AlbunController extends Controller
{
    protected $album, $request;
    
    public function __construct(Request $request, Album $album) {
        
        $this->request = $request;
        $this->album   = $album;
    }
    
    public function index()
    {
        $albums = $this->album->join('estilos', 'estilos.id', '=', 'albuns.id_estilo') 
                              ->select('albuns.*', 'estilos.nome as estilo')
                              ->paginate(10);
                
        return view('painel.albuns.index', compact('albums'));
    }
    
    public function cadastrar()
    {
        //Recupera todos os estilos
        $estilos = Estilo::get();
        
        return view('painel.albuns.cad-edit', compact('estilos'));
    }
    
    public function cadastrarAlbum()
    {
        $dadosForm = $this->request->all();
        
        $validator = validator($dadosForm, $this->album->rules);
        
        if( $validator->fails() )
        {
            return redirect('/painel/album/cadastrar')
                            ->withErrors($validator)
                            ->withInput();
        }
        
        $imagem = $this->request->file('imagem');
        
        $path = public_path('/assets/uploads/imgs/albuns');
        
        $nameImage = date('YmdHms').'.'.$imagem->getClientOriginalExtension();
        $dadosForm['imagem'] = $nameImage;

        $upload =  $imagem->move($path, $nameImage);
        
        if( !$upload )
            return redirect('/painel/albuns/cadastrar')
                            ->withErrors(['errors' => 'Erro ao fazer Upload']);
        
        
        
        $insert = $this->album->create($dadosForm);
                
        if( $insert )
            return redirect("/painel/album/{$insert->id}/musicas/cadastrar");
        else
            return redirect('/painel/album/cadastrar')
                            ->withErrors(['errors' => 'Falha ao Cadastrar'])
                            ->withInput();
    }
    
    public function editar($id)
    {
        //Recupera os estilos musicas
        $estilos = Estilo::get();
        //Recupera o album através do seu id
        $album = $this->album->find($id);
        
        return view('painel.albuns.cad-edit', compact('album', 'estilos'));
    }
    
    public function editarAlbum($id)
    {
        //Recupera os dados do formulário
        $dadosForm = $this->request->all();
        
        //Valida os dados antes de editar
        $validator = validator($dadosForm, $this->album->rulesEdit);
        
        if($validator->fails())
        {
            return redirect("/painel/album/editar/$id")
                            ->withErrors($validator)
                            ->withInput();
        }
        
        //Recupera o estilo pelo seu id
        $item = $this->album->find($id);
        
        if( $this->request->hasFile('imagem') && $this->request->file('imagem')->isValid() ){
            
            $imagem = $this->request->file('imagem');
        
            $path = public_path('/assets/uploads/imgs/albuns');
            
            $nameImage = $item->imagem;
            
            $upload = $imagem->move($path, $nameImage);
            
            if( !$upload )
                return redirect("/painel/album/editar/$id")
                            ->withErrors(['errors' => 'Falha ao fazer o upload']);
            
        }
        
        $dadosForm['imagem'] = $item->imagem;

        //Faz a alteração dos dados
        $update = $item->update($dadosForm);
        
        if( $update )
            return redirect('/painel/albuns');
        else
            return redirect("/painel/album/editar/$id")
                            ->withErrors(['errors' => 'Falha ao Editar'])
                            ->withInput();
    }
    
    public function deletar($id)
    {
        $album = $this->album->find($id);
        
        if ( $album->delete() )
            return '1';
        else
            return 'Falha ao Deletar o Estilo!';
                
    }
    
    public function pesquisar()
    {
       //Recupera a palavra digitada
        $palavraPesquisa = $this->request->get('pesquisar');
        
        //Filtra os dados de acordo com a palavra de pesquisa
        $albums = $this->album
                            ->where('id', 'LIKE', "%$palavraPesquisa%")
                            ->orWhere('nome', 'LIKE', "%$palavraPesquisa%")
                            ->paginate(10);
        
        return view('painel.albuns.index', compact('albums'));
    }
    
    public function musicas($id)
    {
        //recupera o id do album
        $album = $this->album->find($id);
        
        //recupera as musicas do album
        $musicas = $album->musicas;
        
        return view('painel.albuns.musicas', compact('musicas', 'album'));
    }
    
    public function musicasCadastrar($id, Musica $musica)
    {
        //Recupera as informações do Album
        $album = $this->album->find($id);
        
        //Recupera as Musicas
        $musicas = $musica->whereNotIn('id', function($query) use($id)
        {
            $query->select('albuns_musicas.id_musica');
            $query->from('albuns_musicas');
            $query->whereRaw("albuns_musicas.id_album = {$id} ");
            
        })->get();
        
        return view('painel.albuns.vinc_musicas', compact('musicas', 'album'));
    }
    
    public function musicasCadastrarGo($id)
    {
        //recupera as musicas
        $musicas = $this->request->get('musicas');
        
        //recupera o albúm
        $album = $this->album->find($id);
        
        $validator = validator($this->request->all(), $this->album->rulesVincMusic);
        
        if ($validator->fails())
        {
            return redirect("/painel/album/{$id}/musicas/cadastrar")
                                    ->withErrors($validator)
                                    ->withInput();
        }
        
        
        $album->musicas()->attach($musicas);
        
        return redirect("/painel/album/musicas/{$id}");
    }
    
    public function deletarMusicaAlbum($idAlbum, $idMusica)
    {
        $album = $this->album->find($idAlbum);
        
        $musicas = $album->musicas()->detach($idMusica);
        
        return redirect("/painel/album/musicas/{$idAlbum}");
        
       /*
        *  if($musicas->delete())
        * return '1';
        *  else
            return 'Falha ao Deletar o Musica do Album!';
        * 
        */
      
    }

    public function musicaPesquisar($id)
    {
        //recupera o id do album
        $album = $this->album->find($id);
        
        //recupera as musicas do album
        $musicas = $album->musicas()
                ->where('musicas.nome', 'LIKE', "%{$this->request->get('pesquisar')}%")
                ->get();
        
        return view('painel.albuns.musicas', compact('musicas', 'album'));
    }
    
    public function pesquisarMusicaAdd($id, Musica $musica)
    {
      
        //Recupera as informações do Album
        $album = $this->album->find($id);
        
        //Recupera as Musicas
        $musicas = $musica->whereNotIn('id', function($query) use($id)
        {
            $query->select('albuns_musicas.id_musica');
            $query->from('albuns_musicas');
            $query->whereRaw("albuns_musicas.id_album = {$id} ");
            
        })-> where('nome', 'LIKE', "%{$this->request->get('pesquisar')}%")
          ->get();
        
        return view('painel.albuns.vinc_musicas', compact('musicas', 'album'));
    }
    
}
