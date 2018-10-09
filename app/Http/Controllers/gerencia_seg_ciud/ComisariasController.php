<?php

namespace App\Http\Controllers\gerencia_seg_ciud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\gerencia_seg_ciud\Comisarias;
use App\Models\gerencia_seg_ciud\PersonalComisaria;
use App\Models\gerencia_seg_ciud\Observacion;
use App\Models\gerencia_seg_ciud\MapaDelito;


class ComisariasController extends Controller
{

    public function index(Request $request)
    {
        if ($request['tipo'] == 'comisarias') 
        {
            return view('gerencia_seg_ciud/vw_comisarias');
        }
        if ($request['tipo'] == 'mapa_delito') 
        {
            $tipo_delito = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.tipo_delito')->get();
            return view('gerencia_seg_ciud/vw_mapa_delito',compact('tipo_delito'));
        }
        if ($request['tipo'] == 'rutas_serenazgo') 
        { 
            return view('gerencia_seg_ciud/vw_rutas_serenazgo');
        }
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            if($request['show']=='comisarias')
            {
                return $this->traer_datos_comisarias($id);
            }
            if($request['show']=='mapa_delito')
            {
                return $this->traer_datos_mapa_delito($id);
            }
            $comisarias= DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisaria_personal')->where('id',$id)->get();
            return $comisarias;
        }
        else
        {
            if($request['reporte']=='observaciones')
            {
                return $this->abrir_reporte_observaciones($request);
            }
            if($request['grid']=='comisarias')
            {
                return $this->cargar_datos_comisarias($request['nombre']);
            }
            if($request['grid']=='mapa_delito')
            {
                return $this->cargar_datos_mapa_delito($request);
            }
            if($request['mapa']=='comisarias')
            {
                return $this->cargar_mapa_comisarias($request);
            }
            if($request['mapa']=='delitos')
            {
                return $this->cargar_mapa_delitos($request);
            }
            if($request['mapa']=='fotos')
            {
                return $this->cargar_fotos($request['id_mapa']);
            }
        }      
    }
    
    public function store(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->guardar_datos_comisario($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_datos_comisario($request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->editar_datos_comisaria($request);
        }
    }
    
    public function create(Request $request)
    {
        $Observacion = new Observacion;
        $Observacion->observacion    = strtoupper($request['observacion']);
        $Observacion->fecha          = $request['fecha_observacion'];
        $Observacion->id_usuario     = Auth::user()->id;
        $Observacion->id_comisaria   = $request['id_comisaria'];
        $Observacion->fecha_registro = date('d-m-Y');
        
        $Observacion->save();
        return $Observacion->id_observacion;
    }
    
    public function edit($id_mapa_delito,Request $request)
    {
        $MapaDelito = new MapaDelito;
        $val=  $MapaDelito::where("id_mapa_delito","=",$id_mapa_delito )->first();
        if($val)
        {
            $val->ubicacion = strtoupper($request['ubicacion']);
            $val->id_tipo_delito = $request['tipo_delito'];
            $val->id_pers_infractor = $request['infractor'];
            $val->id_pers_encargado = $request['encargado'];
            $val->vehiculo = strtoupper($request['vehiculo']);
            $val->observacion = strtoupper($request['observacion']);
            
            $val->save();
        }
        return $id_mapa_delito;
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
      
    }

    public function traer_datos_dni($id)
    {
        $personas = DB::connection('gerencia_catastro')->table('public.personas')->where('pers_nro_doc',$id)->first();
        if(isset($personas)){
            return response()->json([
                    'nombre' => trim(str_replace('-','',$personas->pers_nombres)),
                    'apaterno' => trim(str_replace('-','',$personas->pers_ape_pat)),
                    'amaterno' => trim(str_replace('-','',$personas->pers_ape_mat)),
            ]);
        }
    }
    
    public function traer_datos_mapa_delito($id)
    {
        $mapa_delito= DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_mapa_delito')->where('id_mapa_delito',$id)->get();
        return $mapa_delito;
    }
    
    public function guardar_datos_comisario(Request $request)
    {
        $Personal = new PersonalComisaria;
        $comisario = $Personal::where('id_comisaria',$request['id_comisaria'])->where('estado',1)->first();
        if ($comisario) 
        {
            $comisario->estado = 0;
            $comisario->fecha_final = date('d-m-Y');
            $comisario->save();
            
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
        else
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
    }
    
    public function editar_datos_comisario(Request $request)
    {
        $file = $request->file('dlg_foto_comisario');
        $PersonalComisaria = new PersonalComisaria;
        $val=  $PersonalComisaria::where("id_comisaria","=",$request['id_comisario'])->first();
        $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.personal_comisaria')->where('id_comisaria',$request['id_comisario'])->get();
        if($val)
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
    
    public function editar_datos_comisaria(Request $request)
    {
        $file = $request->file('dlg_foto_comisaria');
        $Comisarias = new Comisarias;
        $val=  $Comisarias::where("id","=",$request['id_comisaria'])->first();
        $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.comisarias')->where('id',$request['id_comisaria'])->get();
        if($val)
        {
            $val->nombre = strtoupper($request['dlg_nombre_comisaria']);
            $val->ubicacion = strtoupper($request['dlg_ubicacion']);
            $val->telefono = $request['dlg_telefono_comisaria'];
            $val->nro_efectivos = $request['dlg_nro_efectivos'];
            $val->nro_vehiculos = $request['dlg_nro_vehiculos'];

            if ($file) {
                $file_1 = \File::get($file);
                $val->foto = base64_encode($file_1);
            }else{
                $val->foto = $datos[0]->foto;
            }

            $val->id_usuario = Auth::user()->id;
            $val->fecha_registro = $datos[0]->fecha_registro;

            $val->save();
        }
        return $val->id;
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
                '<button class="btn btn-labeled btn-warning" type="button" onclick="crear_observacion('.trim($Datos->id).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> OBSERVACION</button>',
                '<button class="btn btn-labeled btn-success" type="button" onclick="ver_observacion('.trim($Datos->id).')"><span class="btn-label"><i class="fa fa-search"></i></span> VER</button>',
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_mapa_delito(Request $request)
    {
        header('Content-type: application/json');
        $data = $request['data'];
        $fecha_inicio = $request['fecha_inicio'];
        $fecha_fin = $request['fecha_fin'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if ($data == '0') 
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_mapa_delito");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_mapa_delito')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_mapa_delito where fecha_registro between '$fecha_inicio' and '$fecha_fin'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_mapa_delito')->whereBetween('fecha_registro', [$fecha_inicio, $fecha_fin])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
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
            $Lista->rows[$Index]['id'] = $Datos->id_mapa_delito;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_mapa_delito),
                trim($Datos->infractor),
                trim($Datos->descripcion),
                trim($Datos->ubicacion),
                trim($Datos->fecha_registro),
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
        ini_set('memory_limit', '1G');
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
                                'id',id,
                                'x_utm',x_utm,
                                'y_utm',y_utm,
                                'observacion',observacion
                             )
                          ) AS feature
                          FROM (SELECT id,geom,x_utm,y_utm,observacion FROM limpieza_publica.contenedores) row) features;");

        return response()->json($delitos);
      
    }
    
    public function cargar_mapa_basureros(){

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
                          FROM (SELECT * FROM limpieza_publica.contenedores) row) features;");

        return response()->json($delitos);
      
    }
    
    public function cargar_fotos($id_mapa){
        $var = DB::connection('gerencia_catastro')->table('limpieza_publica.contenedores')->where('id',$id_mapa)->first();
        return response()->json([
                'msg' => 'si',
                'foto'=> $var->imagen,
                'observacion'=> $var->observacion,
            ]);
    }
    
    public function abrir_reporte_observaciones(Request $request)
    {
        $observaciones = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_comisaria')->where('id_comisaria',$request['id_comisaria'])->whereBetween('fecha', [$request['fecha_inicio'], $request['fecha_fin']])->orderBy('fecha','asc')->get();
        $comisaria = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.comisarias')->where('id',$request['id_comisaria'])->get();
        $institucion = DB::select('SELECT * FROM maysa.institucion');
        
        if($observaciones)
        {
            set_time_limit(0);
            ini_set('memory_limit', '2G');
            $view =  \View::make('gerencia_seg_ciud.reportes.reporte_observaciones', compact('observaciones','comisaria','institucion'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Reporte Observaciones".".pdf");
        }
        else
        {   return 'No hay datos';}
    }
    
}
