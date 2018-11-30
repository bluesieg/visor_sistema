<?php

namespace App\Http\Controllers\desarrollo_economico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\desarrollo_economico\licencias_funcionamiento;
use App\Models\desarrollo_economico\documentos_adjuntos_lic_fun;
use Illuminate\Support\Facades\Response;


class Licencias_funcionamiento_Controller extends Controller
{

    public function index()
    {
        $usos = DB::connection('gerencia_catastro')->select('select * from desarrollo_economico_local.usos order by uso asc');
        return view('desarrollo_economico/vw_lic_fun', compact('usos'));
    }


       public function create(Request $request)
    {
        
        if($request['tipo_create']=='lic_fun')
        {
            return $this->create_lic_fun($request);
        }
        
    }
    public function create_lic_fun(Request $request)
    {
        $var = new licencias_funcionamiento;
        $var->id_usuario = Auth::user()->id;
        $var->fec_reg = date("d/m/Y");
        $var->id_lote = $request['id'];
        $var->ruc = $request['ruc'];
        $var->ubicacion = strtoupper($request['ubi']);
        $var->representante = strtoupper($request['rep']);
        $var->tip_emp = $request['tip'];
        $var->id_uso = $request['uso'];
        $var->cnt_trabajadores = $request['tra'];
        $var->lic_aprobada = $request['lic'];
        $var->insp_itse = $request['itse'];
        $var->letreros = $request['let'];
        $var->nom_empresa = strtoupper($request['emp']);
        $var->save();
        return $var->id_lic_fun;
    }
    public function create_pdf(Request $request)
    {
        //declar_inscripcion;
        $file = $request->file('dlg_documento_file');
        
        if($file)
        {
            $file2 = \File::get($file);
            $dig=new documentos_adjuntos_lic_fun;
            $dig->archivo = base64_encode($file2);
            $dig->id_lic_fun = $request['id_scan'];
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

       public function show($id, Request $request)
    {
        if($id>0)
        {
            return $this->show_normal($id);
        }
        if($id==0&&$request['grid']=="mapa_lic_fun")
        {
            return $this->mapa($request);
        }
        if($id==0&&$request['grid']=="scan")
        {
            return $this->scaneos($request);
        }
        if($id==0&&$request['grid']=="ver_scan")
        {
            return $this->ver_file($request);
        }
    }
     public function show_normal($id)
    {
        $uno=DB::connection('gerencia_catastro')->table('desarrollo_economico_local.vw_licencias_funcionamiento')->where("id_lote",$id )->get();
        $dos=DB::connection('pgsql')->table('catastro.vw_lotes')->where("id_lote",$id )->get();
        $uno[0]->lote=$dos[0]->codi_lote;
        $uno[0]->manzana=$dos[0]->codi_mzna;
        $uno[0]->sector=$dos[0]->sector;
        return $uno;
    }
     public function scaneos(Request $request)
    {
        $scan=DB::connection('gerencia_catastro')->table('desarrollo_economico_local.documentos_adjuntos_lic_fun')->where("id_lic_fun",$request['id'] )->get();
        return $scan;
    }
    public function ver_file(Request $request)
    {
        $sql = DB::connection('gerencia_catastro')->select('select * from desarrollo_economico_local.documentos_adjuntos_lic_fun where id_doc_adj='.$request['id']);
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
    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /////////////mapa
    function mapa(Request $request){
        $verdes = DB::connection('gerencia_catastro')->select("SELECT * FROM desarrollo_economico_local.licencias_funcionamiento");
        $texto="";
        $inicio=0;
        foreach($verdes as $areas)
        {
           if($inicio==0)
           {
               $texto=$areas->id_lote;
               $inicio=1;
           }
           else
           {
               $texto=$texto.",".$areas->id_lote;
           }
        }
        
        $rutas = DB::connection('pgsql')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_lote',id_lote,
                                'codi_lote', codi_lote
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.lotes where id_lote in (".$texto.")) row) features;");

        return response()->json($rutas);
    }
}
