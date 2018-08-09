<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\procuraduria\Mtrprocuraduria;
use App\Models\procuraduria\Dteprocuraduria;

class ProcuraduriaController extends Controller
{
    public function index()
    {
        $abogados = DB::connection('gerencia_catastro')->table('procuraduria.abogados')->get();
        $tipos = DB::connection('gerencia_catastro')->table('procuraduria.tipo')->get();
        $tipos_sanciones = DB::connection('gerencia_catastro')->table('procuraduria.tipo_sancion')->get();
        $materias = DB::connection('gerencia_catastro')->table('procuraduria.materia')->get();
        $procesos = DB::connection('gerencia_catastro')->table('procuraduria.proceso')->get();
        $casos = DB::connection('gerencia_catastro')->table('procuraduria.caso')->get();
        return view('procuraduria/wv_procuraduria',compact('abogados','tipos','tipos_sanciones','materias','procesos','casos'));
    }
    
    public function create(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->agregar_MtrProcuraduria($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->agregar_DteProcuraduria($request);
        }
    }
    
    public function store(Request $request)
    {
        //
    }
    public function show($id,Request $request)
    {
        if ($request['datos'] == 'datos_expediente') {
            return $this->traer_datos_expediente($request['codigo_exp']);
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
    public function destroy($id)
    {
        //
    }
    
    public function traer_datos_expediente($codigo_expediente)
    {
        $expedientes = DB::connection("sql_crud")->table('vw_catastro')->where('codigoTramite',strtoupper($codigo_expediente))->first();
        
        //$select=DB::connection('gerencia_catastro')->table('soft_lic_edificacion.registro_expediente')->where('nro_exp',$codigo)->get();
        
        if($expedientes)
        {
            /*if (count($select)>=1) {
                
                return response()->json([
                'msg' => 'repetido',
                ]);
                
            }else{*/  
            return response()->json([
                'msg' => 'si',
                'id_gestor'     => $expedientes->idInteresado,
                'gestor'        => $expedientes->nombres,
                'dni'           => $expedientes->numeroIdentificacion,
                'fecha_inicio'  => $expedientes->iniciado,
            ]);
                
            //}
            
        }else{
            return response()->json([
                'msg' => 'no',
            ]);
        }
    }
    
    public function agregar_MtrProcuraduria(Request $request)
    {
        $Mtrprocuraduria = new Mtrprocuraduria;
        $Mtrprocuraduria->nro_expediente           = $request['nro_expediente'];
        $Mtrprocuraduria->id_gestor        = $request['id_gestor'];
        $Mtrprocuraduria->gestor      = $request['gestor'];
        $Mtrprocuraduria->nro_doc_gestor  = $request['dni'];
        $Mtrprocuraduria->fecha_inicio_tramite  = $request['fecha_ini'];
        $Mtrprocuraduria->id_responsable  = $request['id_responsable'];
        $Mtrprocuraduria->id_tipo  = $request['id_tipo'];
        $Mtrprocuraduria->id_hab_urb  = $request['id_hab_urba'];
        $Mtrprocuraduria->nomb_hab_urb  = $request['hab_urba'];
        $Mtrprocuraduria->cod_catastral  = $request['codigo_catastral'];
        $Mtrprocuraduria->id_tipo_sancion  = $request['id_tipo_sancion'];
        $Mtrprocuraduria->id_materia  = $request['id_materia'];
        $Mtrprocuraduria->id_proceso  = $request['id_proceso'];
        $Mtrprocuraduria->id_caso  = $request['id_caso'];
        $Mtrprocuraduria->referencia  = $request['referencia'];
        $Mtrprocuraduria->procedimiento  = $request['procedimiento'];
        
        $Mtrprocuraduria->save();
        
        return response()->json([
            'id_procuraduria' => $Mtrprocuraduria->id_procuraduria,
        ]);
    }
    
    public function agregar_DteProcuraduria(Request $request)
    {
        $Dteprocuraduria = new Dteprocuraduria;
        $Dteprocuraduria->id_mtr_procuraduria   = $request['id_procuraduria'];
        $Dteprocuraduria->fecha_registro        = date('d-m-Y');
        $Dteprocuraduria->observaciones         = $request['observacion'];
        
        $Dteprocuraduria->save();
        
        return $Dteprocuraduria->id_det_procuraduria;
    }
}
