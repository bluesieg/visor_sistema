<?php

namespace App\Http\Controllers\limpieza_publica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\limpieza_publica\contenedores;
use App\Models\limpieza_publica\observaciones_contenedores;
use Illuminate\Support\Facades\Auth;

class Contenedores_Controller extends Controller
{
  
    public function index()
    {
        return view('limpieza_publica/vw_contenedores');
    }

     public function create(Request $request)
    {
        
        if($request['tipo_create']=='observacion')
        {
            return $this->create_observacion_contenedor($request);
        }
    }
    /////creates
    public function create_observacion_contenedor(Request $request)
    {
        $obs = new observaciones_contenedores;
        $obs->id_contenedor = $request['id'];
        $obs->observacion = $request['obs'];
        $obs->fec_obs = $request['fecha'];
        $obs->fec_reg = date("d/m/Y");
        $obs->usuario = Auth::user()->id;
        $obs->save();
        return $obs->id_obs_contenedores;
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
        if($id==0&&$request['grid']=="contenedores")
        {
            return $this->grid_contenedores($request);
        }
         if($id==0&&$request['grid']=="observacion")
        {
            return $this->list_observacion_contenedores($request);
        }
        if($id==0&&$request['grid']=="mapa_contenedores")
        {
            return $this->mapa($request);
        }
        if($id==0&&$request['grid']=="reporte")
        {
            return $this->reporte($request);
        }
    }
    public function show_normal($id)
    {
        return DB::connection('gerencia_catastro')->table('limpieza_publica.contenedores')->where("id",$id )->get();
    }
    
    public function list_observacion_contenedores(Request $request)
    {
        $codigo = strtoupper($request['cod']);
        return DB::connection('gerencia_catastro')->table('limpieza_publica.observaciones_contenedores')->where("id_contenedor",$codigo)->orderBy('id_obs_contenedores','desc' )->get();
    }

    public function edit($id, Request $request)
    {
       $contenedor = new  contenedores;
        $val=  $contenedor::where("id","=",$id )->first();
        if(count($val)>=1)
        {
            $val->codigo = $request['cod'];
            $val->cantidad = $request['cant'];
            $val->estado = $request['estado'];
            $val->ubicacion = strtoupper($request['ubi']);
            $val->save();
        }
        return $id;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function grid_contenedores(Request $request){
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
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.contenedores ");
        $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.contenedores')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
       
        

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
    /////////////mapa
    function mapa(Request $request){
        $rutas = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'observacion', observacion,
                                'imagen', imagen,
                                'ubicacion', ubicacion,
                                'codigo', codigo,
                                'cantidad', cantidad
                             )
                          ) AS feature
                          FROM (SELECT * FROM limpieza_publica.contenedores) row) features;");

        return response()->json($rutas);
    }
    public function reporte(Request $request){
        $sql    =DB::connection('gerencia_catastro')->table('limpieza_publica.contenedores')->orderby('codigo','asc')->get();
        if(count($sql)>=1)
        {
            $view =  \View::make('limpieza_publica.reportes.contenedores', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Botaderos.pdf");
        }
        else
        {
            return "No hay datos";
        }
    }
}
