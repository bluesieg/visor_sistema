<?php

namespace App\Http\Controllers\hab_urbana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\hab_urbana\VerificacionTecnica;
use Illuminate\Support\Facades\Response;



class VerificacionTecnicaController extends Controller
{

    public function index()
    {
       
    }

    public function create(Request $request)
    {
        $file = $request->file('dlg_documento_file1');
                 
        if($file)
        {
            $file2 = \File::get($file);
            $VerificacionTecnica = new  VerificacionTecnica;
            $VerificacionTecnica->id_expediente = $request['hidden_id_expediente_tec'];
            $VerificacionTecnica->id_encargado = $request['select_encargado'];
            $VerificacionTecnica->fch_verif = date('d-m-Y');       
            $VerificacionTecnica->documento =base64_encode($file2);
            $VerificacionTecnica->save();
            Return  $VerificacionTecnica->id_verif_tecnica ;
        }
        else
        {
            return 0;
        }
          
    }
  
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function traer_datos($id,Request $request)
    {
        $expedientes = DB::connection("gerencia_catastro")->table('soft_hab_urbana.vw_expedientes')->where('id_reg_exp',$id)->get();
        return $expedientes;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($id==0)
            {
                $expe=new RegistroExpedientesHabUrb;
                $val=  $expe::where("nro_exp","=",$request['cod'] )->first();
                if(count($val)>=1)
                {
                    return $val;
    }
                else
                {
                    return 0;
                }
            }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function destroy(Request $request)
    {
        $RegistroExpedientesHabUrb = new  RegistroExpedientesHabUrb;
        $val=  $RegistroExpedientesHabUrb::where("id_reg_exp","=",$request['id_reg_exp'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id_reg_exp'];
    }
    
    public function getExpedientes(Request $request){
        header('Content-type: application/json');
        $fecha_desde = $request['fecha_desde'];
        $fecha_hasta = $request['fecha_hasta'];
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_hab_urbana.vw_expedientes where fase=4 and fecha_registro between '$fecha_desde' and '$fecha_hasta'");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_hab_urbana.vw_expedientes')->where('fase',4)->whereBetween('fecha_registro', [$fecha_desde, $fecha_hasta])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->nro_exp),
                trim($Datos->fase),
                trim($Datos->gestor),
                trim($Datos->fecha_inicio_tramite),
                trim($Datos->fecha_registro)
            );
        }

        return response()->json($Lista);

    }
    
}
