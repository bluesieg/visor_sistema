<?php

namespace App\Http\Controllers\vias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\vias\bermas;

class Bermas_Controller extends Controller
{
    public function index()
    {
        return view('vias/vw_man_bermas');
    }

    public function create()
    {
        //
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
         if($id==0&&$request['grid']=="bermas")
        {
            return $this->grid_bermas($request);
        }
         if($id==0&&$request['grid']=="mapa")
        {
            return $this->mapa($request);
        }
         if($id==0&&$request['grid']=="completar_vias")
        {
            return $this->autocomplete_vias($request);
        }
    }

    public function show_normal($id)
    {
        return DB::connection('gerencia_catastro')->table('plan_catastro.bermas')->where("id",$id)->get();
    }
    
    public function edit($id, Request $request)
    {
       $data= new bermas;
        $val=  $data::where("id","=",$id )->first();
        if(count($val)>=1)
        {
            $val->cod_via = $request['cod'];
            $val->lateral_d = $request['der'];
            $val->central = $request['cen'];
            $val->lateral_i = $request['izq'];
            $val->save();
        }
        return $id;
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
     /////show grids, list
     public function grid_bermas(Request $request){
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from plan_catastro.bermas");
            $sql = DB::connection('gerencia_catastro')->table('plan_catastro.bermas')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from plan_catastro.bermas where cod_via like '%$codigo%'");
            $sql = DB::connection('gerencia_catastro')->table('plan_catastro.bermas')->where('cod_via','like','%'.$codigo.'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id),
                trim($Datos->cod_via),
                trim($Datos->lateral_d),
                trim($Datos->central),
                trim($Datos->lateral_i)
            );
        }

        return response()->json($Lista);

    }
    public function mapa(Request $request){
        
        $vias = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'gid',id,
                                'cod_via', cod_via
                             )
                          ) AS feature
                          FROM (SELECT * FROM plan_catastro.bermas) row) features;");

        return response()->json($vias);
    }
}
