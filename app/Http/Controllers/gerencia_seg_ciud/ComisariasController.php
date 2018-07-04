<?php

namespace App\Http\Controllers\gerencia_seg_ciud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\gerencia_seg_ciud\Comisarias;


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
            $comisarias= DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisarias')->where('id',$id_comisaria)->get();
            return $comisarias;
        }
        if($request['grid']=='comisarias')
        {
            return $this->cargar_datos_comisarias($request);
        }
        if($request['mapa']=='comisarias')
        {
            return $this->cargar_mapa_comisarias($request);
        }
    }
    
    public function store(Request $request)
    {
        if ($request['id_comisaria'] == '0') 
        {
            $file = $request->file('dlg_foto_comisario');
            $Comisarias = new Comisarias;
            $Comisarias->nombre         = strtoupper($request['dlg_nombre_comisaria']);
            $Comisarias->ubicacion      = strtoupper($request['dlg_ubicacion']);
            $Comisarias->comisario      = strtoupper($request['dlg_nombre_comisario']);
            $Comisarias->nro_efectivos  = $request['dlg_nro_efectivos'];
            $Comisarias->nro_vehiculos  = $request['dlg_nro_vehiculos'];
            $Comisarias->tlefno_comisario = $request['dlg_telefono_comisario'];
            $Comisarias->tlfno_comsaria = $request['dlg_telefono_comisaria'];
            $Comisarias->observaciones  = strtoupper($request['dlg_observaciones']);
            if ($file) {
                $file_1 = \File::get($file);
                $Comisarias->foto_comisario = base64_encode($file_1);
            }else{
                $Comisarias->foto_comisario = "";
            }
            $Comisarias->save();

            return $Comisarias->id;
        }
        else
        {
            $file = $request->file('dlg_foto_comisario');
            $Comisarias = new Comisarias;
            $val=  $Comisarias::where("id","=",$request['id_comisaria'])->first();
            $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisarias')->where('id',$request['id_comisaria'])->get();
            if(count($val)>=1)
            {
                $val->nombre = strtoupper($request['dlg_nombre_comisaria']);
                $val->ubicacion = strtoupper($request['dlg_ubicacion']);
                $val->comisario = strtoupper($request['dlg_nombre_comisario']);
                $val->nro_efectivos = $request['dlg_nro_efectivos'];
                $val->nro_vehiculos = $request['dlg_nro_vehiculos'];
                $val->tlefno_comisario = $request['dlg_telefono_comisario'];
                $val->tlfno_comsaria = $request['dlg_telefono_comisaria'];
                $val->observaciones = strtoupper($request['dlg_observaciones']);
                if ($file) {
                    $file_1 = \File::get($file);
                    $val->foto_comisario = base64_encode($file_1);
                }else{
                    $val->foto_comisario = $datos[0]->foto_comisario;
                }
                $val->save();
            }
            return $val->id;    
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
    
    public function cargar_datos_comisarias(Request $request)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_comisarias");
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisarias')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
                trim($Datos->ubicacion),
                trim($Datos->tlfno_comsaria),
                trim($Datos->comisario),
                trim($Datos->tlefno_comisario),
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
    
}
