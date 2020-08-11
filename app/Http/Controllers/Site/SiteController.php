<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller; //Adicionar controller
use App\Models\Painel\Album;
use App\Models\Painel\Estilo;

class SiteController extends Controller
{
    
    protected $album, $estilo, $request;
    
    public function __construct(Album $album, Estilo $estilo)
    {
        $this->album    = $album;
        $this->estilo   = $estilo;
    }


    public function index()
    {
        
        $albuns = $this->album->take(4)->orderBy('created_at', 'DESC')->get();
        
        $estilos = $this->estilo->all();
        
        return view('site.home.index', compact('albuns', 'estilos'));
    }
    
    public function albunsEstilo($idEstilo)
    {
        
        $estilo = $this->estilo->find($idEstilo);
        
        //Recupe os albúns deste estilo músical
        $albuns = $estilo->albuns()->get();
        
        return view('site.estilos.albuns', compact('albuns', 'estilo'));
    }
    
    
    public function albumPesquisar(Request $request)
    {
        $palavraPesquisa = $request->get('pesquisa');
        
        //Recupera os albuns através da pesquisa
        $albuns = $this->album
                       ->where('nome', 'LIKE', "%{$palavraPesquisa}%")
                       ->get();
        
        return view('site.albuns.pesquisa', compact('albuns', 'palavraPesquisa'));
    }
    
    public function musicasAlbum($idAlbum)
    {
        //Buscar album através do id
        
        $album = $this->album->find($idAlbum);
        
        //Recupera as músicas do albúm
        $musicas = $album->musicas()->get();
        
        return view('site.albuns.musicas', compact('album', 'musicas'));
        
    }
    
}
