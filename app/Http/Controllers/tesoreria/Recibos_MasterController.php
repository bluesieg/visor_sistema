<?php

namespace App\Http\Controllers\tesoreria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Recibos_Master;
use Illuminate\Support\Facades\Auth;

class Recibos_MasterController extends Controller
{    
    public function index()
    {
        return view('tesoreria/vw_emision_rec_pago');
    }
    
    public function create(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $data = new Recibos_Master();        
        $data->nro_recibo_mtr=6;
        $data->periodo    = date('Y');
        $data->fecha      = date('d-m-Y');
        $data->hora       = date('h:i:s A');
        $data->id_usuario = Auth::user()->id;
        $data->id_est_rec = $request['id_est_rec'];
        $data->id_caja    = 0;        
        $data->hora_pago  = "";
        $data->glosa      = $request['glosa'];
        $data->total      = $request['total'];
        $data->id_tip_pago= 0;
        $data->id_contrib = 0;
        $data->id_tribut_master=0;
        $data->cod_fracc  = 0;
        $data->n_cuot     = 0;
        $data->save();        
        return $data->id_rec_mtr;
    }
   
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
    
    function tabla_Resumen_recibos(Request $request){
        $fecha = $request['fecha'];
        $totalg = DB::select("select count(id_rec_mtr) as total from tesoreria.vw_recibos_resumen where fecha='" . $fecha . "'");
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
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $sql = DB::table('tesoreria.vw_recibos_resumen')->where('fecha',$fecha)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
//        $sql=DB::select("select * from tesoreria.vw_recibos_resumen where fecha='".$fecha."' order by id_contrib asc, id_rec_mtr desc limit 20 offset 0");
        
        $suma = DB::select("select sum(total) as sum_total from tesoreria.vw_recibos_resumen where fecha='" . $fecha . "'");
        $array= array();
        $array['sum_total']=$suma[0]->sum_total;
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        $Lista->userdata=$array;
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_rec_mtr;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_rec_mtr),
                trim($Datos->id_contrib),
                trim($Datos->nro_recibo_mtr),
                trim(date('d-m-Y', strtotime($Datos->fecha))),
                trim($Datos->glosa),                
                trim($Datos->estad_recibo),
                trim($Datos->descrip_caja),
                trim($Datos->hora_pago),
                trim($Datos->total)
            ); 
           
        }        
        return response()->json($Lista);
    }
    
    function completar_tributo(Request $request){
        $tributo = strtoupper($request['tributo']);

        $Consulta = DB::table('presupuesto.vw_tributos_vladi')->where('tributo', 'like', '%'.$tributo.'%')->get();

        $todo = array();
        foreach ($Consulta as $Datos) {
            $Lista = new \stdClass();
            $Lista->value = $Datos->id_tributo;
            $Lista->p_recibo = $Datos->para_recibo;
            $Lista->label = trim($Datos->tributo);
            $Lista->soles = $Datos->soles;
            
            array_push($todo, $Lista);
        }
        return response()->json($todo);
    }
}
