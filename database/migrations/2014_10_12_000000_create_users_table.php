<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
                $table->increments('id');
                $table->string('dni',8);
                $table->string('ape_nom',160);
                $table->string('usuario',50)->unique();            
                $table->string('password',200);
                $table->integer('nivel');
                $table->timestamp('fch_nac');
                $table->string('cad_lar', 200);
                $table->rememberToken();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
