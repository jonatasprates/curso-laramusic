<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
   
    protected $user, $request;
    
    public function __construct(User $user, Request $request) {
        
        $this->user     = $user;
        $this->request  = $request;
        
    }
    
    public function index()
    {
        $users = $this->user->paginate(10);
        
        return view('painel.users.index', compact('users'));
    }
    
    public function cadastrar()
    {   
        return view('painel.users.cad-edit');
    }
    
    public function cadastrarUser()
    {
        $dadosForm = $this->request->all();
        
        $validator = validator($dadosForm, $this->user->rules);
        
        if( $validator->fails() )
        {
            return redirect('/painel/user/cadastrar')
                            ->withErrors($validator)
                            ->withInput();
        }
        
        $dadosForm['password'] = bcrypt($dadosForm['password']);
        
        $insert = $this->user->create($dadosForm);
        
        if( $insert )
        {
            return redirect('/painel/users/');
        }
        else
        {
            return redirect('/painel/user')
                        ->withErrors(['errors' => 'Falha ao cadastrar'])
                        ->withInput();
        }
        
    }
    
    public function editar($id)
    {
       //Recupera o estilo pelo seu id
        $user = $this->user->find($id);
        
        return view('painel.users.cad-edit', compact('user'));
    }
    
    public function editarUser($id)
    {
        $dadosForm = $this->request->all();
        
        $rules = [
            'name' => 'required|min:3|max:100',
            'email' => "required|email|min:3|max:100|unique:users,email,{$id}",
            'password' => 'min:6|max:20'
        ];
        
        $validator = validator($dadosForm, $rules);
        
        if( $validator->fails() )
        {
            return redirect("/painel/user/editar/$id")
                            ->withErrors($validator)
                            ->withInput();
        }
               
        $item = $this->user->find($id);
         
         if( count($dadosForm['password']) > 0 ) 
         {
            $dadosForm['password'] = bcrypt($dadosForm['password']); 
         }
         else
         {
            unset ($dadosForm['password']); 
         }
         
        $update = $item->update($dadosForm);
        
        if( $update )
        {
            return redirect('/painel/users/');
        }
        else
        {
            return redirect("/painel/user/editar/$id")
                        ->withErrors(['errors' => 'Falha ao editar'])
                        ->withInput();
        }
         
    }
    
    public function deletar($id)
    {
        $user = $this->user->find($id);
        
         //Delete o item
        if ( $user->delete() )
            return '1';
        else
            return 'Falha ao Deletar o usuário!';
    }
    
    public function pesquisar()
    {
        
        $palavraPesquisa = $this->request->get('pesquisar');
        
        $users = $this->user->where('name', 'LIKE', "%$palavraPesquisa%")
                           ->orWhere('email', $palavraPesquisa)
                           ->paginate(10);
        
        return view('painel.users.index', compact('users'));
        
    }
    
    
    
}
