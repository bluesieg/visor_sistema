<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProcuraduriaController extends Controller
{
    public function index()
    {
        return view('procuraduria/wv_procuraduria');
    }
    public function create()
    {
        $expedientes = DB::connection("sql_crud")->table('vw_catastro')->where('codigoTramite','151124M3')->first();
        dd($expedientes);
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
