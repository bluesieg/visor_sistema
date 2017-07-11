<?php

namespace App\Http\Controllers\caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Recibos_Master;

class Caja_MovimientosController extends Controller {

    public function index() {
        $est_recibos = DB::select('select * from tesoreria.estados_recibos');
        $tipo_pago = DB::select('select * from tesoreria.tipo_pago');
        $cajero = DB::select('select * from tesoreria.cajas where id_cajero=' . Auth::user()->id);
        return view('caja/vw_caja_Movimient', compact('est_recibos', 'tipo_pago', 'cajero'));
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit(Request $request, $id) {
        date_default_timezone_set('America/Lima');
        $recibo_master = new Recibos_Master();

        $val = $recibo_master::where("id_rec_mtr", "=", $id)->first();
        if (count($val) >= 1) {
            $val->id_tip_pago = $request['id_tip_pago'];
            $val->id_caja = $request['id_caja'];
            $val->fecha = date('d-m-Y');
            $val->hora_pago = date('h:i:s A');
            $val->id_usuario = Auth::user()->id;
            $val->id_est_rec = 2;
            $val->save();
        }
        return $id;
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }

    function get_grid_Caja_Mov(Request $request) {
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
                                ['id_usuario', '=', Auth::user()->id],
                                ['fecha', '=', date('d-m-Y')],
                                ['id_est_rec', '=', $est_recibo]
                        ])
                        ->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

        $suma = DB::select("select sum(total) as sum_total from tesoreria.vw_caja_mov"
                        . " where id_usuario='" . Auth::user()->id . "' and  fecha='" . date('d-m-Y') . "' and id_est_rec='" . $est_recibo . "'");
        $array = array();
        $array['sum_total'] = $suma[0]->sum_total;

        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        $Lista->userdata = $array;

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

    function reportes_caja_mov() {
        $detalle = DB::table('tesoreria.recibos_detalle')->where('id_rec_master', 40)->get();
        $view = \View::make('caja.reportes.pago_recibo', compact('detalle'))->render();
//        return $view;
        if (count($detalle) >= 1) {
            $pdf = \App::make('dompdf.wrapper');
            $paper_size = array(0,0,638,397);
            $pdf->loadHTML($view)->setPaper($paper_size);
            return $pdf->stream();
        }
    }

}
