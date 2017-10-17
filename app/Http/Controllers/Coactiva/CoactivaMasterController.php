<?php

namespace App\Http\Controllers\Coactiva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\DatesTranslator;
use App\Models\coactiva\coactiva_master;

class CoactivaMasterController extends Controller
{
    use DatesTranslator;
    public function index(){}

    public function create($id_contrib){
        $data = new coactiva_master();
        $data->id_contrib = $id_contrib;
        $data->fch_ini = date('Y-m-d');
        $data->estado = 1;
        $data->anio = date('Y');
        $data->save();
        return $data->id_coa_mtr;
    }

    public function store(Request $request){}

    public function show($id){}

    public function edit($id) {}

    public function update(Request $request, $id){}

    public function destroy($id){}
    
    function resep_documentos_op(Request $request){
        $array = explode('-', $request['id_gen_fis']);
        $count=count($array);
//        $id_contrib=0;
        $i=0;
        for($i==0;$i<=$count-1;$i++){            
            DB::table('recaudacion.orden_pago_master')->where('id_gen_fis',$array[$i])
                        ->update(['verif_env'=>1,'fch_recep'=>date('d-m-Y'),'hora_recep'=>date('h:i A')]);
            
            $id_coa_mtr = DB::table('recaudacion.orden_pago_master')->where('id_gen_fis',$array[$i])->value('id_coa_mtr');            
            DB::table('coactiva.coactiva_documentos')->where('id_coa_mtr',$id_coa_mtr)->where('id_tip_doc',1)
                        ->update(['fch_recep'=>date('d-m-Y')]);
        }        
        return response()->json(['msg'=>'si']);
    }
    function resep_documentos_rd(Request $request){
        $array = explode('-', $request['id_rd']);
        $count=count($array);
//        $id_contrib=0;
        $i=0;
        for($i==0;$i<=$count-1;$i++){            
            DB::table('fiscalizacion.resolucion_determinacion')->where('id_rd',$array[$i])
                        ->update(['verif_env'=>1,'fch_recep'=>date('d-m-Y'),'hora_recep'=>date('h:i A')]);
            
            $id_coa_mtr = DB::table('fiscalizacion.resolucion_determinacion')->where('id_rd',$array[$i])->value('id_coa_mtr');
            DB::table('coactiva.coactiva_documentos')->where('id_coa_mtr',$id_coa_mtr)->where('id_tip_doc',1)
                        ->update(['fch_recep'=>date('d-m-Y')]);
        }        
        return response()->json(['msg'=>'si']);
    }
}
