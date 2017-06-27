<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pensionista;

class PensionistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pensionista=new \App\Models\pensionista;
        $val=  $pensionista::where("id_pre","=",$request['id_pre'] )->first();
        if(count($val)>=1)
        {
            $pensionista=$val;
        }
        $pensionista->id_pre = $request['id_pre'];
        $pensionista->id_con = $request['condi'];
        $pensionista->bas_leg = $request['basleg'];
        $pensionista->nro_exp = $request['exp'];
        $pensionista->nro_res = $request['reso'];
        $pensionista->fec_res = $request['fechreso'];
        $pensionista->ani_ini = $request['anini'];
        $pensionista->ani_fin = $request['anfin'];
        $pensionista->save();
        return $pensionista->id_pen;
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $pensionista= DB::table('adm_tri.pensionista')->where('id_pre',$id)->get();
        if(count($pensionista)>=1)
        {
            $pensionista[0]->fec_res=date("d/m/Y",strtotime(str_replace("/", "-", $pensionista[0]->fec_res)));
            return $pensionista;
        }
        else
        {
            return 0;
        }
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
    public function destroy(Request $request)
    {
        $pensionista=new \App\Models\pensionista;
        $val=  $pensionista::where("id_pre","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id'];
    }
}
