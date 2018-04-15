<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroExpedientes;
use App\Models\Notificaciones;
use App\Models\AsignarExpediente;


class EntregaConstanciaController extends Controller
{

    public function index()
    {
      
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $anio1 = DB::select('select anio from adm_tri.uit order by anio asc');
        
        return view('planeamiento_hab_urb/vw_constancia_posesion',compact('anio','anio1'));
    }
    public function reporte_constancia( Request $request)
    {
//        $sql = DB::table('soft_const_posesion.vw_expedientes')->get();
            $sql = DB::table('adm_tri.vw_instalaciones')->get();
        $institucion = DB::select('SELECT * FROM maysa.institucion');
            if($sql)
            {
                set_time_limit(0);
                ini_set('memory_limit', '2G');
                $view = \View::make('planeamiento_hab_urb.reportes.reporte_constancia', compact('sql','institucion'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4');
                return $pdf->stream("PRUEBA".".pdf");
            }
            else
            {
                return 'No hay datos';
            }
    }
   
   
}
