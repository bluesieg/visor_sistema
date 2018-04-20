<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\planeamiento_hab_urb\Documentos_Ajuntos;
use Illuminate\Support\Facades\Response;

class Documentos_AjuntosController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        //declar_inscripcion;
        $file = $request->file('dlg_documento_file');
        
        if($file)
        {
            $file2 = \File::get($file);
            $dig=new Documentos_Ajuntos;
            $dig->id_tip_doc=$request['seltipdoc'];
            $dig->archivo = base64_encode($file2);
            $dig->id_reg_exp = $request['id_scan'];
            $dig->descripcion = $request['dlg_documento_des'];
            $dig->save();
            return $dig->id_doc_adj;
        }
        else
        {
            return 0;
        }
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
    function get_pdf()
    {   
           $file = file_get_contents($_FILES['dlg_documento_file']['tmp_name']);
            if($_FILES["dlg_documento_file"]["type"]=='application/pdf')
            {  
                return Response::make($file, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="prueba"'
                ]);
            }
            else
            {    return "<html><head></head><body style='margin:3px;padding:0px;font-family:verdana;font-size:11px'>No es .pdf</body></html>";$i=0;}
    }
    public function verfile($id)
    {
        $sql = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.documentos_adjuntos where id_doc_adj='.$id);
        if(count($sql)>=1)
        {
            return Response::make(base64_decode($sql[0]->archivo), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="Documento"'
                ]);
        }
        else
        {
            return "No hay Archvos";
        }
    }
}
