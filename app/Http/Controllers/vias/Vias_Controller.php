<?php

namespace App\Http\Controllers\vias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\vias\vias_geom;

class Vias_Controller extends Controller
{
     public function index()
    {
        return view('vias/vw_man_vias');
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
         if($id==0&&$request['grid']=="vias")
        {
            return $this->grid_vias($request);
        }
         if($id==0&&$request['grid']=="completar_vias")
        {
            return $this->autocomplete_vias($request);
        }
    }
    public function show_normal($id)
    {
        return DB::connection('pgsql')->table('catastro.vias_geom')->where("gid",$id)->get();
    }
    public function autocomplete_vias(Request $request){

        $Consulta = DB::connection('pgsql')->select('select * from catastro.vias_geom order by nombre_via asc');
        $todo = array();
        foreach ($Consulta as $Datos) {
            $Lista = new \stdClass();
            $Lista->value = $Datos->gid;
            $Lista->label = trim($Datos->cod_via)."-".trim($Datos->nombre_via);
            array_push($todo, $Lista);
        }

        return response()->json($todo);

    }
    public function edit($id, Request $request)
    {
       $vias= new  vias_geom;
        $val=  $vias::where("gid","=",$id )->first();
        if(count($val)>=1)
        {
            $val->cod_via = $request['cod'];
            $val->nombre_via = $request['nom'];
            $val->tipo_via = $request['tip'];
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
    /////show grids, list
     public function grid_vias(Request $request){
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
            $totalg = DB::connection('pgsql')->select("select count(*) as total from catastro.vias_geom");
            $sql = DB::connection('pgsql')->table('catastro.vias_geom')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            if($request['tip']==1)
            {
                $totalg = DB::connection('pgsql')->select("select count(*) as total from catastro.vias_geom where cod_via like '%$codigo%'");
                $sql = DB::connection('pgsql')->table('catastro.vias_geom')->where('cod_via','like','%'.$codigo.'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            }
            if($request['tip']==2)
            {
                $totalg = DB::connection('pgsql')->select("select count(*) as total from catastro.vias_geom where nombre_via like '%$codigo%'");
                $sql = DB::connection('pgsql')->table('catastro.vias_geom')->where('nombre_via','like','%'.$codigo.'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            }

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
            $Lista->rows[$Index]['id'] = $Datos->gid;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->gid),
                trim($Datos->cod_via),
                trim($Datos->nombre_via),
                trim($Datos->tipo_via)
            );
        }

        return response()->json($Lista);

    }
}
