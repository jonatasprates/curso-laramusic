<?php

use Illuminate\Database\Seeder;
use App\User; //Adicionando model User

class UserTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Jonatas Prates',
            'email'     => 'contato@tiws.com.br',
            'password'  => bcrypt('123456')
        ]);
    }
}
