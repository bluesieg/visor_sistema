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
            'name'      => 'vlady',
            'email'      => 'ss@gmail.com', 
            'password'      => bcrypt('admin')
        ]); 
    }
}
