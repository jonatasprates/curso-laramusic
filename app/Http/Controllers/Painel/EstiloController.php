<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Painel\Estilo;

class EstiloController extends Controller
{
    
    protected $estilo, $request;
    
    public function __construct(Estilo $estilo,  Request $request) {
        
        $this->estilo  = $estilo;
        $this->request = $request;
        
    }

    
    /**
    * Tela Inicial do Painel
    *
    *@return type
    */
    
    
    public function index()
    {
        //Recupera os dados e mostra 10 itens por página em ordem decrescente
        $estilos = $this->estilo->orderBy('nome', 'ASC')->paginate(10);
        
        return view('painel.estilos.index', compact('estilos'));
    }
    
    
    /**
    * Exibe o formulário de cadastro
    *
    *@return type
    */
    
    
    public function cadastrar()
    {
        return view('painel.estilos.cad-edit');
    }
    
    
    /**
    * Cadastro estilo musical
    *
    *@return type
    */
    
    
    public function cadastrarEstilo()
    {
        $dadosForm = $this->request->all();
        
        $validator = validator($dadosForm, $this->estilo->rules);
        
        if($validator->fails())
        {
            return redirect('/painel/estilo/cadastrar')
                            ->withErrors($validator)
                            ->withInput();
        }
        
        $insert = $this->estilo->create($dadosForm);
        
        if( $insert )
            return redirect('/painel/estilos');
        else
            return redirect('/painel/estilo/cadastrar')
                            ->withErrors(['errors' => 'Falha ao Cadastrar'])
                            ->withInput();
        
    }
    
    
    /**
    * Tras os dados no formulário
    *
    *@return type
    */
    
    public function editar($id)
    {
        //Recupera o estilo pelo seu id
        $estilo = $this->estilo->find($id);
        
        return view('painel.estilos.cad-edit', compact('estilo'));
    }
    
    
    /**
    * Faz alteração do Dados
    *
    *@return type
    */
        
    
    public function editarEstilo($id)
    {
        //Recupera os dados do formulário
        $dadosForm = $this->request->all();
        
        //Valida os dados antes de editar
        $validator = validator($dadosForm, $this->estilo->rules);
        
        if($validator->fails())
        {
            return redirect("/painel/estilo/editar/$id")
                            ->withErrors($validator)
                            ->withInput();
        }
        
        //Recupera o estilo pelo seu id
        $estilo = $this->estilo->find($id);
        
        //Faz a alteração dos dados
        $update = $estilo->update($dadosForm);
        
        if( $update )
            return redirect('/painel/estilos');
        else
            return redirect("/painel/estilo/editar/$id")
                            ->withErrors(['errors' => 'Falha ao Editar'])
                            ->withInput();
    }
    
    
    /**
    * Deleta um Registro
    *
    *@return type
    */
    
    
    public function deletar($id)
    {
        //Recupera o item pelo seu id
        $estilo = $this->estilo->find($id);
        
        //Delete o item
        if ( $estilo->delete() )
            return '1';
        else
            return 'Falha ao Deletar o Estilo!';
       
    }
    
     /**
    * Pesquisar Registro
    *
    *@return type
    */
    
    public function pesquisar()
    {
       //Recupera a palavra digitada
        $palavraPesquisa = $this->request->get('pesquisar');
        
        //Filtra os dados de acordo com a palavra de pesquisa
        $estilos = $this->estilo
                            ->where('id', 'LIKE', "%$palavraPesquisa%")
                            ->orWhere('nome', 'LIKE', "%$palavraPesquisa%")
                            ->paginate(10);
        
        return view('painel.estilos.index', compact('estilos'));
    }
    
}
