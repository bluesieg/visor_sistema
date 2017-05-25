<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'dni'       => '12345678',
            'ape_nom'   => 'Vladimiro Velasquez',
            'usuario'   => 'Admin',
            'password'  => bcrypt('admin'),
            'nivel'     => 1,
            'fch_nac'   => date('d-m-Y H:i:s'),
            'cad_lar'   => 'Vladimiro Velasquez 12345678'
        ]); 
        
        factory(App\User::class, 30)->create();
  
    }
}
