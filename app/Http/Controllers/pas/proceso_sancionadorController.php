<?php

namespace App\Http\Controllers\pas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\pas\registro_expe_sancionador;
use Illuminate\Support\Facades\Auth;
use App\Traits\DatesTranslator;
use App\Models\pas\infracciones_verificadas;

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
        if($request['tipo_create']=='infracciones_verificadas')
        {
            return $this->create_infracciones_verificadas($request);
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
    public function create_infracciones_verificadas(Request $request)
    {
        $pas=new infracciones_verificadas;
        $pas->id_exp_san = $request['id_exp_san'];
        $pas->id_infraccion = $request['id_infraccion'];
        $pas->monto = $request['monto'];
        $pas->porcentaje = $request['porcentaje'];
        $pas->total = $request['total'];
        $pas->infra_veric_obs = $request['observaciones'];
        $pas->fec_reg = date("d/m/Y");
        $pas->usu_reg = Auth::user()->id;
        $pas->save();
        return $pas->id_infra_veric;
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
        if($id==0&&$request['grid']=="autocompleta_sancion")
        {
            return $this->autocompletar_sancion();
        }
        if($id==0&&$request['grid']=="infracciones_verificadas")
        {
            $infracciones=DB::connection('gerencia_catastro')->table('soft_pas.infracciones_verificadas')->where('id_exp_san',$request['id_exp_san'])->get();
            return $infracciones;
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
    public function autocompletar_sancion(){
        $Consulta = DB::connection("gerencia_catastro")->table('soft_pas.infracciones')->get();  
        $uit = DB::select("select * from adm_tri.uit where anio='".date('Y')."'");
        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new \stdClass();           
            $Lista->value=$Datos->id_infraccion;
            $Lista->label=  trim($Datos->cod_infraccion)."-".trim($Datos->des_infraccion);           
            $Lista->codi=  trim($Datos->cod_infraccion);           
            $Lista->sancion=  trim($Datos->accion_infraccion);           
            $Lista->tipo=  trim($Datos->tipo_cobro);           
            $Lista->porcentaje_cobro=  trim($Datos->porcentaje_cobro); 
            $Lista->uit=  $uit[0]->uit;           
            array_push($todo,$Lista);
        }        
        return response()->json($todo);
    }
}
