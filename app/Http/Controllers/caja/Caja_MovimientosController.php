<?php

namespace App\Http\Controllers\caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Caja_MovimientosController extends Controller
{
    
    public function index()
    {
        $est_recibos = DB::select('select * from tesoreria.estados_recibos');
        $tipo_pago = DB::select('select * from tesoreria.tipo_pago');
        return view('caja/vw_caja_Movimient',compact('est_recibos','tipo_pago'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
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
    
    function get_grid_Caja_Mov(Request $request){
        $est_recibo = $request['est_recibo'];
        $totalg = DB::select("select count(id_rec_mtr) as total from tesoreria.vw_caja_mov"
                . " where id_usuario='" . Auth::user()->id . "' and  fecha='" . date('d-m-Y') . "' and id_est_rec='" . $est_recibo . "'");
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

        $sql = DB::table('tesoreria.vw_caja_mov')
                ->where([
                    ['id_usuario','=', Auth::user()->id],
                    ['fecha','=',date('d-m-Y')],
                    ['id_est_rec','=',$est_recibo]
                ])
                ->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $suma = DB::select("select sum(total) as sum_total from tesoreria.vw_caja_mov"
                . " where id_usuario='" . Auth::user()->id . "' and  fecha='" . date('d-m-Y') . "' and id_est_rec='" . $est_recibo . "'");
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
}
