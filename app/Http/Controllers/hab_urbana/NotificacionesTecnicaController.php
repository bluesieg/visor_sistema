<?php

namespace App\Http\Controllers\hab_urbana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\hab_urbana\NotificacionesTecnica;


class NotificacionesTecnicaController extends Controller
{

    public function index()
    {
        
    }

    public function create(Request $request)
    {
          
                $NotificacionesTecnica = new  NotificacionesTecnica;
                $NotificacionesTecnica->id_expediente = $request['id_expediente'];
                $NotificacionesTecnica->txt_notificacion=utf8_encode($request['txt_notificacion']);
                $NotificacionesTecnica->fec_reg=date("d/m/Y");
                $NotificacionesTecnica->save();
                Return  $NotificacionesTecnica->id_notificacion_tecnica ;
                
    }
     
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {       
          $NotificacionesTecnica = new  NotificacionesTecnica;
         $val= $NotificacionesTecnica::where("id_expediente","=",$id )->first();
         if(count($val)>=1)
         {
             $val->fec_notificacion = date('d-m-Y');
             $val->save();
         }
         return $val->id_notificacion_admin;
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
    public function rep_notificacion_verif_tecnica($id)
    {
        $institucion = DB::select('SELECT * FROM maysa.institucion');
        $notificacion=DB::connection('gerencia_catastro')->table('soft_hab_urbana.notificaciones_tecnica')->where('id_expediente',$id)->get();
        $sql=DB::connection('gerencia_catastro')->table('soft_hab_urbana.registro_expediente_hab_urb')->where('id_reg_exp',$id)->get();

        if(count($sql)>0)
        {
            //$notificacion->fec_reg=$this->getCreatedAtAttribute($notificacion->fec_reg)->format('l d \d\e F \d\e\l Y ');
            set_time_limit(0);
            ini_set('memory_limit', '2G');
            $view =  \View::make('hab_urbana.reportes.notificacion_verif_admin', compact('sql','notificacion','institucion'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Predios por Usuario".".pdf");
        }
        else
        {   return 'No hay datos';}
    }
   
}
