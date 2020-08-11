<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Painel\Musica;

class MusicaController extends Controller
{
    
    protected $musica, $request;
    
    public function __construct(Musica $musica, Request $request) {
       
        $this->musica  = $musica;
        $this->request = $request;
        
    }
    
    public function index()
    {
        $musicas = $this->musica->paginate(10);
        
        return view('painel.musicas.index', compact('musicas'));
    }
    
    public function cadastrar()
    {
        return view('painel.musicas.cad-edit');
    }
    
    public function cadastrarMusica()
    {
        //Pega os dados do formulário
        $dadosForm = $this->request->all();
        
        $validator = validator($dadosForm, $this->musica->rules);
        
        if($validator->fails())
        {
            return redirect('/painel/musica/cadastrar')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        //Recupera o campo de upload
        $musica = $this->request->file('arquivo');
        
        //define o caminho na pasta
        $path = public_path('/assets/uploads/musics');
        
        //define o nome da música
        $nameMusic = date('YmdHms').'.'.$musica->getClientOriginalExtension();
        $dadosForm['arquivo'] = $nameMusic;
        
        //Faz o upload da musica para a pasta
        $upload = $musica->move($path, $nameMusic);
        
        if( !$upload )
            return redirect('/painel/musica/cadastrar')
                            ->withErrors(['errors' => 'Falha ao fazer o upload']);
        
        $insert = $this->musica->create($dadosForm);
        
        if( $insert )
        {
            return redirect('/painel/musicas');
        }
        else
        {
            return redirect('/painel/musica/cadastrar')
                            ->withErrors(['errors' => 'Falha ao Cadastrar'])
                            ->withInput();
        }
        
    }
    
    public function editar($id)
    {
        
        $musica = $this->musica->find($id);
        
        return view('painel.musicas.cad-edit', compact('musica'));
    }
    
    public function editarMusica($id)
    {
        
        $dadosForm = $this->request->all();
        
        $validator = validator($dadosForm, $this->musica->rulesEdit);
        
        if ( $validator->fails() ){
            return redirect("/painel/musica/editar/$id")
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $item = $this->musica->find($id);
        
        //Se existe o arquivo para o upload
        if ( $this->request->hasFile('arquivo') && $this->request->file('arquivo')->isValid() )
        {
            //Recupera o campo de upload
           $musica = $this->request->file('arquivo');

           //define o caminho na pasta
           $path = public_path('/assets/uploads/musics');

           //define o nome da música
           $nameMusic = $item->arquivo;

           //Faz o upload da musica para a pasta
           $upload = $musica->move($path, $nameMusic);

           if( !$upload )
               return redirect('/painel/musica/cadastrar')
                               ->withErrors(['errors' => 'Falha ao fazer o upload']);
        }
        
        $dadosForm['arquivo'] = $item->arquivo;
        $update = $item->update($dadosForm);
        
        if( $update )
        {
            return redirect('/painel/musicas');
        }
        else
        {
            return redirect("/painel/musica/editar/$id")
                            ->withErrors(['errors' => 'Falha ao Editar'])
                            ->withInput();
        }
    }
    
    public function deletar($id)
    {

        $musica = $this->musica->find($id);
        
         //Delete o item
        if ( $musica->delete() )
            return '1';
        else
            return 'Falha ao Deletar a Música!';
        
    }
    
    public function pesquisar()
    {
        //Recupera a palavra digitada
        $palavraPesquisa = $this->request->get('pesquisar');
        
        //Filtra os dados de acordo com a palavra de pesquisa
        $musicas = $this->musica
                            ->where('id', 'LIKE', "%$palavraPesquisa%")
                            ->orWhere('nome', 'LIKE', "%$palavraPesquisa%")
                            ->paginate(10);
        
        return view('painel.musicas.index', compact('musicas'));
    }
    
}
