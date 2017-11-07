<?php

namespace App\Http\Controllers\archivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\archivo\Arch_Contribuyente;
use App\Traits\DatesTranslator;

class Arch_ContribuyenteController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_archi_contrib' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $tip_doc = DB::connection('digitalizacion')->select("select * from tipdoc_contrib");
        return view('archivo/vw_archi_contribuyente', compact('menu','permisos','tip_doc'));
    }

    public function create(Request $request)
    {
        $contri=new Arch_Contribuyente;
        $contri->tip_documento=$request['tip'];
        $contri->nro_documento=$request['num'];
        $contri->nombres=strtoupper ($request['contri']);
        $contri->domicilio=strtoupper ($request['dom']);
        $contri->observaciones=strtoupper ($request['obs']);
        $contri->nro_expediente=strtoupper ($request['exp']);
        $contri->fch_nac=$request['fec'];
        $contri->save();
        return $contri->id_contrib;
        
    }
  

    public function store(Request $request)
    {
    }

    public function show($id, Request $request)
    {
        if($id>0)
        {
            $contrivw= DB::connection('digitalizacion')->table('vw_contribuyentes')->where('id_contrib',$id)->get();
        }
        else
        {
            if($request['exp']==0)
            {
                $contrivw= DB::connection('digitalizacion')->table('vw_contribuyentes')->where('nro_documento',$request['num'])->get();
            }
            else
            {
                $contrivw= DB::connection('digitalizacion')->table('vw_contribuyentes')->where('nro_expediente',$request['exp'])->get();
            }
            
        }
        return $contrivw;
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
    
    function grid_contrib(Request $request){
 
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        if($request['name']=='0')
        {
            $totalg = DB::connection('digitalizacion')->select("select count(id_contrib) as total from vw_contribuyentes");
            $sql = DB::connection('digitalizacion')->table('vw_contribuyentes')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('digitalizacion')->select("select count(id_contrib) as total from vw_contribuyentes where contribuyente like '%".strtoupper($request['name'])."%'");
            $sql = DB::connection('digitalizacion')->table('vw_contribuyentes')->where('contribuyente','like', '%'.strtoupper($request['name']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
       
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
            $Lista->rows[$Index]['id'] = $Datos->id_contrib;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_contrib),
                trim($Datos->tip_documento),
                trim($Datos->documento),
                trim($Datos->nro_documento),
                trim($Datos->contribuyente),
                trim($this->getCreatedAtAttribute($Datos->fch_nac)->format('d/m/Y')),
                trim($Datos->domicilio),
                trim($Datos->nro_expediente)            
               
            );
        }
        return response()->json($Lista);
    }
    public function validar(Request $request)
    {
        $count = DB::connection('digitalizacion')->table('vw_contribuyentes')->where('nro_expediente',$request['exp'])->count();
        if($count==0)
        {
            return $count;
        }
        else
        {
            $poseedores=DB::connection('digitalizacion')->table('vw_contribuyentes')->select('contribuyente')->where('nro_expediente',$request['exp'])->get();
            $lista="";
            foreach ($poseedores as $contri)
            {
                $lista=$lista."<br>".$contri->contribuyente;
            }
            return $lista;
        }
    }
}

