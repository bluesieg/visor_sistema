<?php

namespace App\Http\Controllers\Coactiva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoactivaDocumentosController extends Controller
{
    
    public function index(){}

    public function create(){}


    public function edit($id) {}

    function rec_cierre(){
//        $documento=DB::select('select * from coactiva.vw_documentos_edit where id_doc='.$id_doc);
        $view = \View::make('coactiva.reportes.rec_cierre')->render();
        $pdf = \App::make('dompdf.wrapper');            
        $pdf->loadHTML($view)->setPaper('a4');
        return $pdf->stream();
//        return view('coactiva.reportes.rec_cierre');
    }

    public function destroy($id){}
}
