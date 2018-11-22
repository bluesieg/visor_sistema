<?php

namespace App\Http\Controllers\limpieza_publica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\limpieza_publica\rutas_barrido_calles;
use App\Models\limpieza_publica\personal_barrido_calles;
use Illuminate\Support\Facades\Auth;
use App\Models\limpieza_publica\observaciones_rutas_barrido_calles;

class Barrido_Calles_Controller extends Controller
{
   
    public function index()
    {
        return view('limpieza_publica/vw_mod_barrido_calles');
    }

    public function create(Request $request)
    {
        if($request['tipo_create']=='personal')
        {
            return $this->create_personal_barrido($request);
        }
        if($request['tipo_create']=='observacion')
        {
            return $this->create_observacion_barrido($request);
        }
    }
    /////creates
    public function create_personal_barrido(Request $request)
    {
       $personal = new personal_barrido_calles;
        $personal->id_ruta_barrido = $request['id_ruta_barrido'];
        $personal->nombres = strtoupper($request['nombres']);
        $personal->ape_pat = strtoupper($request['ape_pat']);
        $personal->ape_mat = strtoupper($request['ape_mat']);
        $personal->fec_reg = date("d/m/Y");
        $personal->usuario = Auth::user()->id;
        $personal->dni = $request['dni'];
        $personal->telefono = $request['fono'];
        $personal->save();
        return $personal->id_per_barrido;
    }
    public function create_observacion_barrido(Request $request)
    {
        $obs = new observaciones_rutas_barrido_calles;
        $obs->id_ruta_barrido = $request['id_ruta_barrido'];
        $obs->observacion = $request['obs'];
        $obs->fec_obs = $request['fecha'];
        $obs->fec_reg = date("d/m/Y");
        $obs->usuario = Auth::user()->id;
        $obs->save();
        return $obs->id_obs_barrido_calles;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id, Request $request)
    {
         if($id==0&&$request['grid']=="rutas_barrido")
        {
            return $this->grid_rutas_barrido($request);
        }
         if($id==0&&$request['grid']=="personal")
        {
            return $this->grid_personal_barrido($request);
        }
         if($id==0&&$request['grid']=="observacion")
        {
            return $this->list_observacion_barrido($request);
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
       $Ruta = new  rutas_barrido_calles;
        $val=  $Ruta::where("id_ruta_barrido","=",$id )->first();
        if(count($val)>=1)
        {
            $val->cod_ruta_barrido = $request['cod'];
            $val->descripcion = $request['des'];
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
            $personal= new personal_barrido_calles;
            $val=  $personal::where("id_per_barrido","=",$request['id'] )->first();
            if(count($val)>=1)
            {
                $val->delete();
            }
        }
        return "destroy ".$request['id'];
    }
    
    /////show grids, list
     public function grid_rutas_barrido(Request $request){
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.rutas_barrido_calles");
            $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.rutas_barrido_calles')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.rutas_barrido_calles where cod_ruta_barrido like '%$codigo%'");
            $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.rutas_barrido_calles')->where('cod_ruta_barrido','like','%'.$codigo.'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
         
            $Lista->rows[$Index]['id'] = $Datos->id_ruta_barrido;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_ruta_barrido),
                trim($Datos->cod_ruta_barrido),
                trim($Datos->descripcion)
            );
        }

        return response()->json($Lista);

    }
     public function grid_personal_barrido(Request $request){
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
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.personal_barrido_calles where id_ruta_barrido=".$codigo);
        $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.personal_barrido_calles')->where("id_ruta_barrido",$codigo)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
       
        

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
         
            $Lista->rows[$Index]['id'] = $Datos->id_per_barrido;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_per_barrido),
                trim($Datos->dni),
                trim($Datos->ape_pat)." ".trim($Datos->ape_mat)." ".trim($Datos->nombres),
                trim($Datos->telefono),
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="quitar_personal('.trim($Datos->id_per_barrido).')"><span class="btn-label"><i class="fa fa-remove"></i></span> Quitar</button>'

            );
        }

        return response()->json($Lista);

    }
    public function list_observacion_barrido(Request $request)
    {
        $codigo = strtoupper($request['cod']);
        return DB::connection('gerencia_catastro')->table('limpieza_publica.observaciones_rutas_barrido_calles')->where("id_ruta_barrido",$codigo)->orderBy('id_obs_barrido_calles','desc' )->get();
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
                                'id_ruta_barrido',id_ruta_barrido,
                                'descripcion', descripcion,
                                'cod_ruta_barrido', cod_ruta_barrido
                             )
                          ) AS feature
                          FROM (SELECT * FROM limpieza_publica.rutas_barrido_calles) row) features;");

        return response()->json($rutas);
    }
    public function reporte(Request $request){
        $sql    =DB::connection('gerencia_catastro')->table('limpieza_publica.rutas_barrido_calles')->orderby('cod_ruta_barrido','asc')->get();
        if(count($sql)>=1)
        {
            $view =  \View::make('limpieza_publica.reportes.barrido', compact('sql'))->render();
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
