<?php

namespace App\Http\Controllers\fiscalizacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Genera_fisca;

class FiscalizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectores = DB::select('select * from catastro.sectores order by id_sec');
        $manzanas = DB::select('select * from catastro.manzanas where id_sect=(select id_sec from catastro.sectores order by id_sec limit 1) ');
        
        return view('fiscalizacion/vw_fiscalizacion',compact('sectores','manzanas'));
    }

    public function create(Request $request)
    {
        if($request['tip']=='1')
        {
            return $this->create_by_user($request['per']);
        }
        
    }
    public function create_by_user($per)
    {
        $fisca= new Genera_fisca;
        $fisca->anio=date("Y");
        $fisca->fec_reg=date("d/m/Y");
        $fisca->id_per=$per;
        $fisca->save();
        return $fisca->id_gen_fis;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    public function reporte($tip,$id,$sec,$man) 
    {
        
        if($tip=='1')
        {
            $sql    =DB::table('fiscalizacion.vw_genera_fisca')->where('id_gen_fis',$id)->get()->first();
            $view =  \View::make('fiscalizacion.reportes.po', compact('sql'))->render();
        }
        
        if(count($sql)>=1)
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("PO.pdf");
        }
        else
        {   return 'No hay datos';}
    }
}
