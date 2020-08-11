<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Painel\Estilo;
use App\Models\Painel\Album;
use App\Models\Painel\Musica;
use App\User;

class PainelController extends Controller
{
    
    protected $estilo, $album, $musica, $user;
    
    public function __construct(Estilo $est, Album $alb, Musica $music, User $use) {
        
        $this->estilo   = $est;
        $this->album   = $alb;
        $this->musica   = $music;
        $this->user   = $use;
        
    }


    public function index()
    {
        
        $estilos = $this->estilo->count();
        $albuns = $this->album->count();
        $musicas = $this->musica->count();
        $users = $this->user->count();
        
        
        return view('painel.home.index', compact('estilos', 'albuns', 'musicas', 'users'));
    }
}
