<?php

namespace App\Http\Controllers\fiscalizacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\DatesTranslator;

class Res_DeterminacionController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('fiscalizacion/vw_res_deter',compact('anio_tra'));
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
    
}
