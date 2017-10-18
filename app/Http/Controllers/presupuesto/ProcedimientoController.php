<?php

namespace App\Http\Controllers\presupuesto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProcedimientoController extends Controller
{
    public function index(){
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('presupuesto.vw_procedimientos',compact('anio'));
    }

    public function create(){}

    public function edit($id){}

    public function destroy($id){}
}
