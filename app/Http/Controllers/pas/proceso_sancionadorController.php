<?php

namespace App\Http\Controllers\pas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\pas\registro_expe_sancionador;
use Illuminate\Support\Facades\Auth;
use App\Traits\DatesTranslator;

class proceso_sancionadorController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $tipo_proceso = DB::connection("gerencia_catastro")->select('select * from soft_pas.tipo_proceso');
        return view('pas/vw_pas',compact('tipo_proceso'));
    }

    public function create(Request $request)
    {
        if($request['tipo_create']=='registro_expe_sancionador')
        {
            return $this->create_exp_sancionador($request);
        }
    }
    public function create_exp_sancionador(Request $request)
    {
        $pas=new registro_expe_sancionador;
        $pas->id_lote = $request['id_lote'];
        $pas->id_tipo_proceso = $request['tip_doc'];
        $pas->tipo_persona = $request['tip_per'];
        $pas->anio = date('Y');
        $pas->nro_doc_persona = $request['nro_doc'];
        $pas->ape_pat = strtoupper ($request['ape_pat']);
        $pas->ape_mat = strtoupper ($request['ape_mat']);
        $pas->nombres = strtoupper ($request['nombres']);
        $pas->razon_social = strtoupper ($request['raz_soc']);
        $pas->dom_fiscal = strtoupper ($request['dom_fis']);
        $pas->fec_reg = date("d/m/Y");
        $pas->usu_reg = Auth::user()->id;
        $pas->save();
        return $pas->id_exp_san;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id,Request $request)
    {
        if($id==0&&$request['grid']=="registro_expe_sancionador")
        {
            return $this->grid_registro_expe_sancionador($request);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    
    public function grid_registro_expe_sancionador(Request $request){
        header('Content-type: application/json');
        $fecha_desde = $request['fecha_desde'];
        $fecha_hasta = $request['fecha_hasta'];
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_pas.registro_expe_sancionador where fec_reg between '$fecha_desde' and '$fecha_hasta'");
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

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
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }

     

        $sql = DB::connection('gerencia_catastro')->table('soft_pas.registro_expe_sancionador')->whereBetween('fec_reg', [$fecha_desde, $fecha_hasta])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            if($Datos->tipo_persona==1)
            {
                $persona=trim($Datos->ape_pat)." ".trim($Datos->ape_mat)." ".trim($Datos->nombres);
            }
            if($Datos->tipo_persona==2)
            {
                $persona=trim($Datos->razon_social);
            }
            $Lista->rows[$Index]['id'] = $Datos->id_exp_san;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_exp_san),
                trim($Datos->nro_exp_san),
                trim($Datos->anio),
                $persona,
                $this->getCreatedAtAttribute($Datos->fec_reg)->format('d/m/Y')
            );
        }

        return response()->json($Lista);

    }
}
