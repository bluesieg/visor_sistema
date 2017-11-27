<?php

namespace App\Http\Controllers\archivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatesTranslator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BusquedasController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_arch_busqueda' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        return view('archivo/vw_busquedas', compact('menu','permisos'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        //
    }
    public function get_cotrib(Request $request) 
    {
        header('Content-type: application/json');
        if($request['tip']=="1")
        {
            $sql = DB::connection('digitalizacion')->select('select id_tip_doc,documento,count(id) from vw_digital where id_contribuyente='.$request['dat'].' group by id_tip_doc,documento order by id_tip_doc');
        }
        if($request['tip']=="2")
        {
            $sql = DB::connection('digitalizacion')->select('select anio,count(id) from vw_digital where id_contribuyente='.$request['dat'].' group by anio order by anio');
        }
        return response()->json($sql);
    }
    public function get_cotrib_byname(Request $request) 
    {
        if($request['dat']=='0')
        {
            return 0;
        }
        else
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
        if($request['tip']=="1")
        {
            $totalg = DB::connection('digitalizacion')->select("select count(id_contrib) as total from vw_contribuyentes where nro_documento like '%".strtoupper($request['dat'])."%'");
            $sql = DB::connection('digitalizacion')->table('vw_contribuyentes')->where('nro_documento','like', '%'.strtoupper($request['dat']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        if($request['tip']=="2")
        {
            $totalg = DB::connection('digitalizacion')->select("select count(id_contrib) as total from vw_contribuyentes where nro_expediente like '%".strtoupper($request['dat'])."%'");
            $sql = DB::connection('digitalizacion')->table('vw_contribuyentes')->where('nro_expediente','like', '%'.strtoupper($request['dat']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        if($request['tip']=="3")
        {
            $totalg = DB::connection('digitalizacion')->select("select count(id_contrib) as total from vw_contribuyentes where nombres like '%".strtoupper($request['dat'])."%'");
            $sql = DB::connection('digitalizacion')->table('vw_contribuyentes')->where('nombres','like', '%'.strtoupper($request['dat']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        if($request['tip']=="4")
        {
            $consulta="";$iniciador=0;
            $direcs = explode(" ", strtoupper($request['dat']));
            foreach($direcs as $dirs)
            {
                if($iniciador==1)
                {
                    $consulta.=" AND ";
                }
                if($dirs!="")
                {
                    $consulta.="direccion like '%$dirs%'";
                }
                if($iniciador==0)
                {
                    $iniciador=1;
                }
            }
            $totalg = DB::connection('digitalizacion')->select("select count(id_contribuyente) as total from vw_digital where $consulta");
            $sql = DB::connection('digitalizacion')->select("select id_contribuyente as id_contrib,nombres,nro_documento,domicilio,nro_expediente from vw_digital where $consulta GROUP BY id_contribuyente,nombres,nro_documento,domicilio,nro_expediente");
        }
        if($request['tip']=="5")
        {
            $consulta="";$iniciador=0;
            $observaciones = explode(" ", strtoupper($request['dat']));
            foreach($observaciones as $obs)
            {
                if($iniciador==1)
                {
                    $consulta.=" AND ";
                }
                if($obs!="")
                {
                    $consulta.="observacion like '%$obs%'";
                }
                if($iniciador==0)
                {
                    $iniciador=1;
                }
            }
            $totalg = DB::connection('digitalizacion')->select("select count(id) as total from vw_digital where $consulta");
            $sql = DB::connection('digitalizacion')->select("select id_contribuyente as id_contrib,nombres,nro_documento,domicilio,nro_expediente from vw_digital where $consulta GROUP BY id_contribuyente,nombres,nro_documento,domicilio,nro_expediente");
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
                trim($Datos->nro_documento),
                trim(str_replace("-", "",$Datos->nombres)),
                trim($Datos->domicilio),
                trim($Datos->nro_expediente),
            );
        }
        return response()->json($Lista);
        }
    }
    
    function grid_expe_busqueda(Request $request){
         if($request['contrib']==0)
         {
             return 0;
         }
         else
         {
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }
            if($request['tip_doc']=="0")
            {
                if($request['fin']=="0")
                {
                    $totalg = DB::connection('digitalizacion')->select("select count(id) as total from vw_digital where anio=".$request['an']." and id_contribuyente=".$request['contrib']);
                    $sql = DB::connection('digitalizacion')->table('vw_digital')->where('id_contribuyente',$request['contrib'])->where('anio',$request['an'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                }
                else
                {
                    $totalg = DB::connection('digitalizacion')->select("select count(id) as total from vw_digital where anio between ".$request['an']." and ".$request['fin']." and id_contribuyente=".$request['contrib']);
                    $sql = DB::connection('digitalizacion')->table('vw_digital')->where('id_contribuyente',$request['contrib'])->whereBetween('anio', array($request['an'], $request['fin']))->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                }
            }
            else
            {
                $totalg = DB::connection('digitalizacion')->select("select count(id) as total from vw_digital where id_tip_doc=".$request['tip_doc']." and id_contribuyente=".$request['contrib']);
                $sql = DB::connection('digitalizacion')->table('vw_digital')->where('id_contribuyente',$request['contrib'])->where('id_tip_doc',$request['tip_doc'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
                    trim($Datos->anio),
                    trim($Datos->documento),
                    trim($this->getCreatedAtAttribute($Datos->fecha)->format('d/m/Y')),
                    trim($Datos->observacion),
                    '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile('.trim($Datos->id).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver</button>',
                );
            }
            return response()->json($Lista);
        }
     }
}
