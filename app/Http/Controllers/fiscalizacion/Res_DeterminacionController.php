<?php

namespace App\Http\Controllers\fiscalizacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Res_DeterminacionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function carta_requerimiento()
    {

        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $fiscalizadores = DB::select('select * from fiscalizacion.vw_fiscalizadores where flg_act=1');
        return view('fiscalizacion/vw_carta_requerimiento',compact('anio_tra','fiscalizadores'));
    }
}
