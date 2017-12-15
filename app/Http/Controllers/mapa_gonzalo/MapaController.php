<?php

namespace App\Http\Controllers\mapa_gonzalo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MapaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        $sectores = DB::select('SELECT  id_sec, sector FROM catastro.sectores order by sector asc;');
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('mapa_gonzalo/mapa', compact('sectores','anio_tra','menu'));
    }
    
    function get_datos(){

        $sql =  DB::connection('mapa')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                            )
                            FROM (
                              SELECT json_build_object(
                                'type',       'Feature',
                                'gid',          gid,
                                'text',        text,
                                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                                'properties', json_build_object(
                                   'gid', gid
                                 )
                              ) AS feature
                              FROM (SELECT * FROM public.jurisdiccion) row) features;");

        return response()->json($sql);

    }

    

}
