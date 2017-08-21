<?php

namespace App\Http\Controllers\fraccionamiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ConvenioDetalle;

class Convenio_DetalleController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $data = new ConvenioDetalle();
        $data->id_conv_mtr  = $request['id_conv'];
        $data->nro_cuota    = $request['nro_cuota'];
        $data->monto        = $request['monto'];
        $data->interes      = $request['interes'];
        $fecha=explode("-", $request['fec_pago']);
        $mes=$fecha[1];
        switch ($mes) {
            case 'ene':
                $fecha[1]='01';
                break;
            case 'feb':
                $fecha[1]='02';
                break;
            case 'mar':
                $fecha[1]='03';
                break;
            case 'abr':
                $fecha[1]='04';
                break;
            case 'may':
                $fecha[1]='05';
                break;
            case 'jun':
                $fecha[1]='06';
                break;
            case 'jul':
                $fecha[1]='07';
                break;
            case 'ago':
                $fecha[1]='08';
                break;
            case 'sep':
                $fecha[1]='09';
                break;
            case 'oct':
                $fecha[1]='10';
                break;
            case 'nov':
                $fecha[1]='11';
                break;
            case 'dic':
                $fecha[1]='12';
                break;
        }
        $fecha=implode("/", $fecha);
        $data->fec_pago     = $fecha;
        $data->total        = $request['total'];
        $data->estado       = $request['estado'];        
        $data->fecha_q_pago = $request['fecha_q_pago'];
        $data->saldo        = $request['saldo'];        
        $data->save();        
        return $data->id_conv_mtr;
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
}
