<?php

namespace App\Http\Controllers\gerencia_seg_ciud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\gerencia_seg_ciud\Comisarias;
use App\Models\gerencia_seg_ciud\PersonalComisaria;


class ComisariasController extends Controller
{

    public function index()
    {
        return view('gerencia_seg_ciud/vw_comisarias');
    }

    public function show($id_comisaria,Request $request)
    {
        if ($id_comisaria > 0) 
        {
            $comisarias= DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisaria_personal')->where('id',$id_comisaria)->get();
            return $comisarias;
        }
        if($request['grid']=='comisarias')
        {
            return $this->cargar_datos_comisarias($request['nombre']);
        }
        if($request['mapa']=='comisarias')
        {
            return $this->cargar_mapa_comisarias($request);
        }
        
        if($request['mapa']=='delitos')
        {
            return $this->cargar_mapa_delitos($request);
        }
    }
    
    public function store(Request $request)
    {
        if ($request['id_comisario'] == '0') 
        {
            $file = $request->file('dlg_foto_comisario');
            $PersonalComisaria = new PersonalComisaria;
            $PersonalComisaria->dni           = $request['dlg_dni_comisario'];
            $PersonalComisaria->nombre        = strtoupper($request['dlg_nombre_comisario']);
            $PersonalComisaria->telefono      = $request['dlg_telefono_comisario'];
            $PersonalComisaria->fecha_inicio  = $request['dlg_fecha_inicio'];
            $PersonalComisaria->tipo_per = 1;
            
            if ($file) {
                $file_1 = \File::get($file);
                $PersonalComisaria->foto = base64_encode($file_1);
            }else{
                $PersonalComisaria->foto = "";
            }
            
            $PersonalComisaria->id_usuario = Auth::user()->id;
            $PersonalComisaria->estado  = 1;
            $PersonalComisaria->id_comisaria  = $request['id_comisaria'];
            $PersonalComisaria->fecha_registro = date('d-m-Y');
            $PersonalComisaria->save();

            return $PersonalComisaria->id_personal_comisaria;
        }
        if ($request['id_comisario'] > 0)
        {
            $file = $request->file('dlg_foto_comisario');
            $PersonalComisaria = new PersonalComisaria;
            $val=  $PersonalComisaria::where("id_comisaria","=",$request['id_comisario'])->first();
            $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.personal_comisaria')->where('id_comisaria',$request['id_comisario'])->get();
            if(count($val)>=1)
            {
                $val->dni = $request['dlg_dni_comisario'];
                $val->nombre = strtoupper($request['dlg_nombre_comisario']);
                $val->telefono = $request['dlg_telefono_comisario'];
                $val->fecha_inicio = $request['dlg_fecha_inicio'];
                $val->tipo_per = 1;
                
                
                if ($file) {
                    $file_1 = \File::get($file);
                    $val->foto = base64_encode($file_1);
                }else{
                    $val->foto = $datos[0]->foto;
                }
                
                $val->id_usuario = Auth::user()->id;
                $val->estado = 1;
                $val->id_comisaria = $request['id_comisario'];
                $val->fecha_registro = $datos[0]->fecha_registro;
                
                $val->save();
            }
            return $val->id_personal_comisaria;    
        }
       
    }
    
    public function create(Request $request)
    {
        
    }
    
    public function edit(Request $request)
    {
       
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
      
    }
    
    public function cargar_datos_comisarias($nombre)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_comisarias where nombre like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisarias')->where('nombre','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

        $total_pages = 0;
        if (!$sidx) {
            $sidx = 1;
        }
        $count = $totalg[0]->total;
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id),
                trim($Datos->nombre),
                trim($Datos->telefono),
                trim($Datos->nro_vehiculos),
                trim($Datos->nro_efectivos),
                trim($Datos->ubicacion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_mapa_comisarias(){

        $comisarias = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'nombre',nombre,
                                'id',id,
                                'x',x,
                                'y',y,
                                'ubicacion',ubicacion,
                                'comisario',comisario,
                                'nro_efectivos',nro_efectivos,
                                'nro_vehiculos',nro_vehiculos,
                                'tlefno_comisario',tlefno_comisario,
                                'tlfno_comsaria',tlfno_comsaria,
                                'foto_comisario',foto_comisario
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_seg_ciudadana.comisarias) row) features;");

        return response()->json($comisarias);
      
    }
    
    public function cargar_mapa_delitos(){

        $delitos = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'x_utm',x_utm,
                                'y_utm',y_utm,
                                'imagen',imagen,
                                'observacion',observacion
                             )
                          ) AS feature
                          FROM (SELECT * FROM public.coordenadas) row) features;");

        return response()->json($delitos);
      
    }
    
}
