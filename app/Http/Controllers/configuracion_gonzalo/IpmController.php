<?php

namespace App\Http\Controllers\configuracion_gonzalo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IpmController extends Controller
{

    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_indice_precios_mayor' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $anio = DB::select('SELECT pk_uit,anio FROM adm_tri.uit order by anio desc');
        $mes = DB::select('SELECT mes,n_mes FROM configuracion.vw_reajuste_ipm order by mes asc');
        return view('configuracion_gonzalo/vw_indice_precios_mayor', compact('menu','permisos','anio','mes'));
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
       $ipm = DB::table('configuracion.vw_reajuste_ipm')->where('id_ipm',$id)->get();
       return $ipm;
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
    
    public function insertar_nuevo_ipm(Request $request){
        header('Content-type: application/json');
        $data = $request->all();
        $insert=DB::table('configuracion.ipm')->insert($data);

        if ($insert) return response()->json($data);
        else return false;
    }
    
    function modificar_ipm(Request $request) {
        $data = $request->all();
        unset($data['id_ipm']);
        $update=DB::table('configuracion.ipm')->where('id_ipm',$request['id_ipm'])->update($data);
        if ($update){
            return response()->json([
                'msg' => 'si',
            ]);
        }else return false;
    }
    
    function eliminar_ipm(Request $request){
        $delete = DB::table('configuracion.ipm')->where('id_ipm', $request['id_ipm'])->delete();

        if ($delete) {
            return response()->json([
                'msg' => 'si',
            ]);
        }
    }
    
    public function getIpm(Request $request){
        header('Content-type: application/json');

        $totalg = DB::select("select count(id_ipm) as total from configuracion.vw_reajuste_ipm where id_anio='".$request['anio']."'");
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

     

        $sql = DB::table('configuracion.vw_reajuste_ipm')->where('id_anio',$request['anio'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_ipm;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_ipm),
                trim($Datos->n_mes),
                trim($Datos->valor),
            );
        }

        return response()->json($Lista);

    }
    
}
