<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\personas\personas;


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_mod_persona' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $tip_doc = DB::select("select * from adm_tri.tipo_documento");
        return view('adm_tributaria/vw_modificar_persona', compact('menu','permisos','tip_doc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id, Request $request)
    {
        if($id==0)
        {
           return $this->grid_persona($request);
        }
        if($id>0)
        {
           return DB::select('select * from adm_tri.vw_personas where id_pers='.$id);
        }
    }
    function grid_persona(Request $request){
        $buscar=$request['name'];
        if($request['name']!='0'){
            $totalg = DB::select("select count(id_pers) as total from adm_tri.vw_personas where contribuyente||' '||pers_nro_doc like '%".$buscar."%'");
        }else{
            $totalg = DB::select('select count(id_pers) as total from adm_tri.vw_personas');
        }
        
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
        if($request['name']!='0'){
            $sql = DB::select("select * from adm_tri.vw_personas where contribuyente||' '||pers_nro_doc like '%".$buscar."%' order by $sidx $sord limit $limit offset $start");
        }else{
            $sql = DB::table('adm_tri.vw_personas')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_pers;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_pers),
                trim($Datos->pers_nro_doc),
                trim($Datos->pers_tip_doc),
                trim(str_replace("-", "",$Datos->contribuyente)), 
                trim($Datos->pers_raz_soc),
                
            );
        }
        return response()->json($Lista);
    }
   
    public function edit($id, Request $request)
    {
        $persona=new personas;
        $val=  $persona::where("id_pers","=",$id )->first();
        if(count($val)>=1)
        {
            $val->pers_ape_pat=strtoupper($request['apep']);
            $val->pers_ape_mat=strtoupper($request['apem']);
            $val->pers_nombres=strtoupper($request['nom']);
            $val->pers_raz_soc=strtoupper($request['razsoc']);
            $val->pers_tip_doc=$request['tipdoc'];
            
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
    public function destroy($id)
    {
        //
    }
}
