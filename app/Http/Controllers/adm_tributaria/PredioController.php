<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Predios;

class PredioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectores = DB::select('select * from catastro.sectores');
        $manzanas = DB::select('select * from catastro.manzanas where id_sect=1 ');
        $condicion = DB::select('select * from adm_tri.cond_prop order by id_cond ');
        return view('adm_tributaria/vw_predio', compact('sectores','manzanas','condicion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $predio=new Predios;
        $predio->id_cond_prop = $request['condpre'];
        $predio->nro_condominios = $request['condos'];
        $predio->id_via = $request['cvia'];
        $predio->nro_mun = $request['n'];
        $predio->mzna_dist = $request['mz'];
        $predio->lote_dist = $request['lt'];
        $predio->zona = $request['zn'];
        $predio->secc = $request['secc'];
        $predio->piso = $request['piso'];
        $predio->dpto = $request['dpto'];
        $predio->nro_int = $request['int'];
        $predio->referencia = $request['ref'];
        $predio->id_est_const = 1;
        $predio->id_tip_pred = 1;
        $predio->id_contrib = $request['contrib'];
        $predio->id_exon = 1;
        $predio->id_cond_esp_exon = 1;
        $predio->id_uso_predio = '010101';
        $predio->id_hab_urb = 1;
        $predio->id_form_adq = 1;
        $predio->mzna = $request['mzna'];
        $predio->sec = $request['sec'];
        $predio->lote = $request['lote'];
        $predio->anio = date("Y");
        $predio->cod_cat = $request['sec'].$request['mzna'].$request['lote'];
        
        $predio->save();
        
        echo $predio->id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "store";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $predio=new Predios;
        $val=  $predio::where("id_pred","=",$id )->first();
        if(count($val)>=1)
        {
            $val->id_cond_prop = $request['condpre'];
            $val->nro_condominios = $request['condos'];
            $val->id_via = $request['cvia'];
            $val->nro_mun = $request['n'];
            $val->mzna_dist = $request['mz'];
            $val->lote_dist = $request['lt'];
            $val->zona = $request['zn'];
            $val->secc = $request['secc'];
            $val->piso = $request['piso'];
            $val->dpto = $request['dpto'];
            $val->nro_int = $request['int'];
            $val->referencia = $request['ref'];
            $val->save();
        }
        return "edit".$id;
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
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo "destroy";
    }
    public function ListManz(Request $request)
    {
        $manzanas = DB::table('catastro.manzanas')->where('id_sect',$request['sec'])->orderBy('codi_mzna')->get();
        
        $todo=array();
        foreach($manzanas as $Datos){      
            $Lista=new \stdClass();
            $Lista->id_mzna      =  trim($Datos->id_mzna);
            $Lista->codi_mzna         =  trim($Datos->codi_mzna);
            array_push($todo, $Lista);
                      
        }        
        return response()->json($todo);
    }
    public function GetContrib(Request $request)
    {
        $contri = DB::table('adm_tri.vw_contribuyentes')->where('id_pers',$request['contri'])->get();
        return response()->json($contri);
    }
    public function listpredio(Request $request)
    {
        header('Content-type: application/json');
        $secmn= $request['mnza'];
        $totalg = DB::select("select count(id_pred) as total from adm_tri.vw_predi_urba where id_mzna='$secmn' and anio='".date("Y")."'");
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
        
        $sql = DB::select("select * from adm_tri.vw_predi_urba where id_mzna='$secmn' and anio='".date("Y")."'");
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_pred;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_pred),
                trim($Datos->tp),
                trim($Datos->lote),
                trim($Datos->cod_cat),
                trim($Datos->mzna_dist), 
                trim($Datos->lote_dist),
                trim($Datos->nro_mun),
                trim($Datos->descripcion),
                trim($Datos->contribuyente),               
                trim($Datos->nom_via),               
                trim($Datos->id_via),               
                trim($Datos->are_terr),               
                trim($Datos->val_ter),               
                trim($Datos->val_const),               
                trim($Datos->id_cond_prop),               
                trim($Datos->id_contrib),               
                trim($Datos->nro_doc),               
                trim($Datos->cod_via),               
                trim($Datos->dpto),               
                trim($Datos->zona),               
                trim($Datos->secc),               
                trim($Datos->piso),               
                trim($Datos->nro_int),               
                trim($Datos->referencia),               
                trim($Datos->nro_condominios),               
                              
                
            );
        }
        return response()->json($Lista);
    }
}
