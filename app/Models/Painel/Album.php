<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albuns';
    
    protected $fillable = [
        'id_estilo', 
        'nome',
        'imagem'
    ];

    public $rules = [
        'id_estilo' => 'required',
        'nome'      => 'required|min:3|max:150',
        'imagem'    => 'required|image|max:3000|mimes:jpg,png,jpeg'
    ];
    
    public $rulesEdit = [
        'id_estilo' => 'required',
        'nome'      => 'required|min:3|max:150',
        'imagem'    => 'image|max:3000|mimes:jpg,png,jpeg'
    ];
    
    public $rulesVincMusic = [
        'musicas' => 'required'
    ];
    
    public function musicas()
    {
        return $this->belongsToMany('App\Models\Painel\Musica', 'albuns_musicas', 'id_album', 'id_musica');
    }
}
