<?php

namespace App\Http\Controllers\limpieza_publica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\limpieza_publica\rutas_recojo;
use App\Models\limpieza_publica\personal_recojo;
use Illuminate\Support\Facades\Auth;
use App\Models\limpieza_publica\observaciones_rutas_recojo;
use App\Models\limpieza_publica\unidad_transporte;

class Recojo_Residuos_Controller extends Controller
{

    public function index()
    {
        $tipo = DB::connection('gerencia_catastro')->table('limpieza_publica.tipo_persona_recojo')->get();
        return view('limpieza_publica/vw_mod_recojo_residuos', compact('tipo'));
    }

    public function create(Request $request)
    {
        if($request['tipo_create']=='personal')
        {
            return $this->create_personal_recojo($request);
        }
        if($request['tipo_create']=='observacion')
        {
            return $this->create_observacion_recojo($request);
        }
        if($request['tipo_create']=='transporte')
        {
            return $this->create_transporte($request);
        }
    }
    /////creates
    public function create_personal_recojo(Request $request)
    {
       $personal = new personal_recojo;
        $personal->id_ruta_recojo = $request['id_ruta_recojo'];
        $personal->nombres = strtoupper($request['nombres']);
        $personal->ape_pat = strtoupper($request['ape_pat']);
        $personal->ape_mat = strtoupper($request['ape_mat']);
        $personal->fec_reg = date("d/m/Y");
        $personal->usuario = Auth::user()->id;
        $personal->dni = $request['dni'];
        $personal->telefono = $request['fono'];
        $personal->id_tipo_per = $request['tipo_personal'];
        $personal->save();
        return $personal->id_per_recojo;
    }
    public function create_observacion_recojo(Request $request)
    {
        $obs = new observaciones_rutas_recojo;
        $obs->id_ruta_recojo = $request['id_ruta_barrido'];
        $obs->observacion = $request['obs'];
        $obs->fec_obs = $request['fecha'];
        $obs->fec_reg = date("d/m/Y");
        $obs->usuario = Auth::user()->id;
        $obs->save();
        return $obs->id_obs_recojo;
    }
    public function create_transporte(Request $request)
    {
        $car = new unidad_transporte;
        $car->placa = strtoupper($request['placa']);
        $car->capacidad = $request['capacidad'];
        $car->save();
        return $car->id_uni_trans;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id, Request $request)
    {
         if($id==0&&$request['grid']=="rutas_recojo")
        {
            return $this->grid_rutas_recojo($request);
        }
         if($id==0&&$request['grid']=="personal")
        {
            return $this->grid_personal_recojo($request);
        }
        if($id==0&&$request['grid']=="observacion")
        {
            return $this->list_observacion_recojo($request);
        }
        if($id==0&&$request['grid']=="uni_transporte")
        {
            return $this->grid_transporte($request);
        }
         if($id==0&&$request['grid']=="rutas_geom")
        {
            return $this->rutas_mapa($request);
        }
        if($id==0&&$request['grid']=="reporte")
        {
            return $this->reporte($request);
        }
    }

     public function edit($id, Request $request)
    {
        $Ruta = new  rutas_recojo;
        $val=  $Ruta::where("id_ruta_recojo","=",$id )->first();
        if(count($val)>=1)
        {
            if($request['tipo_edit']=='ruta')
            {
                $val->cod_ruta_recojo = $request['cod'];
                $val->descripcion = $request['des'];
            }
            if($request['tipo_edit']=='transporte')
            {
                $val->id_uni_trans = $request['cod'];
            }
            
            $val->save();
        }
        return $id;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        if($request['tipo']=='personal')
        {
            $personal= new personal_recojo;
            $val=  $personal::where("id_per_recojo","=",$request['id'] )->first();
            if(count($val)>=1)
            {
                $val->delete();
            }
        }
        return "destroy ".$request['id'];
    }
    
    /////show grids, list
    public function grid_rutas_recojo(Request $request){
        header('Content-type: application/json');
        $codigo = strtoupper($request['cod']);
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }
        if($codigo=='0')
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.vw_rutas_recojo");
            $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.vw_rutas_recojo')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.vw_rutas_recojo where cod_ruta_recojo like '%$codigo%'");
            $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.vw_rutas_recojo')->where('cod_ruta_recojo','like','%'.$codigo.'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
         
            $Lista->rows[$Index]['id'] = $Datos->id_ruta_recojo;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_ruta_recojo),
                trim($Datos->cod_ruta_recojo),
                trim($Datos->descripcion),
                trim($Datos->placa)
            );
        }

        return response()->json($Lista);

    }
    public function grid_personal_recojo(Request $request){
        header('Content-type: application/json');
        $codigo = strtoupper($request['cod']);
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.vw_personal_recojo where id_ruta_recojo=".$codigo);
        $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.vw_personal_recojo')->where("id_ruta_recojo",$codigo)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
       
        

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
         
            $Lista->rows[$Index]['id'] = $Datos->id_per_recojo;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_per_recojo),
                trim($Datos->dni),
                trim($Datos->ape_pat)." ".trim($Datos->ape_mat)." ".trim($Datos->nombres),
                trim($Datos->telefono),
                trim($Datos->des_tip_per),
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="quitar_personal('.trim($Datos->id_per_recojo).')"><span class="btn-label"><i class="fa fa-remove"></i></span> Quitar</button>'

            );
        }

        return response()->json($Lista);

    }
    public function grid_transporte(Request $request){
        header('Content-type: application/json');
        $codigo = strtoupper($request['cod']);
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.unidad_transporte ");
        $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.unidad_transporte')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
         
            $Lista->rows[$Index]['id'] = $Datos->id_uni_trans;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_uni_trans),
                trim($Datos->placa),
                trim($Datos->capacidad),
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="poner_tranporte('.trim($Datos->id_uni_trans).','."'".$Datos->placa."'".')"><span class="btn-label"><i class="fa fa-remove"></i></span> Asignar</button>'

            );
        }

        return response()->json($Lista);

    }
    public function list_observacion_recojo(Request $request)
    {
        $codigo = strtoupper($request['cod']);
        return DB::connection('gerencia_catastro')->table('limpieza_publica.observaciones_rutas_recojo')->where("id_ruta_recojo",$codigo)->orderBy('id_obs_recojo','desc' )->get();
    }
    //////////////////////mapas
    function rutas_mapa(){
        $rutas = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_ruta_recojo',id_ruta_recojo,
                                'descripcion', descripcion,
                                'cod_ruta_recojo', cod_ruta_recojo,
                                'placa', placa
                             )
                          ) AS feature
                          FROM (SELECT * FROM limpieza_publica.vw_rutas_recojo) row) features;");

        return response()->json($rutas);
    }
    
    public function reporte(Request $request){
        $sql    =DB::connection('gerencia_catastro')->table('limpieza_publica.vw_rutas_recojo')->orderby('cod_ruta_recojo','asc')->get();
        if(count($sql)>=1)
        {
            $view =  \View::make('limpieza_publica.reportes.recojo', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Barrido.pdf");
        }
        else
        {
            return "No hay datos";
        }
    }
}
