<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\configuracion\Obras_Complementarias;


class ObrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_obras_complementarias' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $tip_doc = DB::select("select * from adm_tri.tipo_documento");
        $anio = DB::select('SELECT anio FROM adm_tri.uit order by anio desc');//filtro año
        return view('configuracion/vw_obras_complementarias', compact('menu','permisos','tip_doc','anio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $instalaciones = new  Obras_Complementarias;
        $instalaciones->cod_instal = $request['cod_instal'];
        $instalaciones->descrip_instal = $request['descrip_instal'];
        $instalaciones->unid_medida = $request['unid_medida'];
        $instalaciones->precio = $request['precio'];
        $instalaciones->anio = $request['aniox'];
        $instalaciones->save();
        
        return $instalaciones->id_instal;

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
       $tributos = DB::table('catastro.vw_instalaciones')->where('id_instal',$id)->get();
       return $tributos;
    }
    function grid_obras(Request $request){
       
        $totalg = DB::select("select count(id_instal) as total from catastro.vw_instalaciones where anio=".$request['anio']."");//contar los registros
        
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

        $sql = DB::table('catastro.vw_instalaciones')->where('anio',$request['anio'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();//
        
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_instal;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_instal),
                trim($Datos->cod_instal),
                trim($Datos->descrip_instal),
                trim($Datos->unid_medida), 
                trim($Datos->precio),
                
            );
        }
        return response()->json($Lista);
    }
   
    public function edit($id, Request $request)
    {
        $instalacion=new Obras_Complementarias;
        $val=  $instalacion::where("id_instal","=",$id )->first();
        if(count($val)>=1)
        {
            $val->cod_instal=strtoupper($request['cod_instal']);
            $val->descrip_instal=strtoupper($request['descrip_instal']);
            $val->unid_medida=strtoupper($request['unid_medida']);
            $val->precio=strtoupper($request['precio']);
                      
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
        $instalacion = new  Obras_Complementarias;
        $val=  $instalacion::where("id_instal","=",$request['id_instal'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id_instal'];
    }
}
