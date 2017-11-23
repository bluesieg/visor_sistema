<?php

namespace App\Http\Controllers\catastro_gonzalo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViasController extends Controller
{

    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='conf_catastro_vc' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        
        $vias =  DB::select('SELECT id_tip_via, tip_via FROM catastro.ta_tip_via');
        $hab_urbanas =  DB::select('SELECT id_hab_urb,id_tip_hab, nomb_hab_urba FROM catastro.hab_urb order by id_hab_urb asc');
        return view('catastro_gonzalo/vw_catastro_vias_calles', compact('menu','permisos','vias','hab_urbanas'));
    }

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
    public function show($id)
    {
       $vias_calles = DB::table('catastro.vias')->where('id_via',$id)->get();
       return $vias_calles;
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
    
    public function insertar_nueva_vc(Request $request){
        header('Content-type: application/json');
        $data = $request->all();
        
        $select=DB::table('catastro.vias')->where('cod_via',$request['cod_via'])->get();
        
        if (count($select)>0) {
            return response()->json([
                'msg' => 'si',
            ]);
        }else{
            $insert=DB::table('catastro.vias')->insert($data);
            return response()->json($data);
        }
    }
    
    function modificar_vc(Request $request) {
        $data = $request->all();
        unset($data['id_via']);
        
        $select=DB::table('catastro.vias')->where('cod_via',$request['cod_via'])->where('id_via','<>',$request['id_via'])->get();
              
        if (count($select)>0) {
            return response()->json([
                'msg' => 'si',
            ]);
        }else{
            $update=DB::table('catastro.vias')->where('id_via',$request['id_via'])->update($data);
            return response()->json($data);
        }
    }
    
    function eliminar_vc(Request $request){
        $delete = DB::table('catastro.vias')->where('id_via', $request['id_via'])->delete();

        if ($delete) {
            return response()->json([
                'msg' => 'si',
            ]);
        }
    }
    
    public function getVias(Request $request){
        header('Content-type: application/json');

        $totalg = DB::select("select count(id_via) as total from catastro.vw_vias2");
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
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }

     

        $sql = DB::table('catastro.vw_vias2')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_via;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_via),
                trim($Datos->cod_via),
                trim($Datos->nom_via),
                trim($Datos->tip_via),
            );
        }

        return response()->json($Lista);

    }
    
}
