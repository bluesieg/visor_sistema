<?php

namespace App\Http\Controllers\map;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MapController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
//       if (Auth::check())
//        {
//            return view('home');
//        }
//        else return view('auth/login');

        //$lotes = DB::select('SELECT ST_AsGeoJSON(geometria) from catastro.lotes;');
        $sectores = DB::connection('mapa')->select('SELECT gid, entity, codigo, sector FROM mdcc_2017.sectores_cat order by codigo asc;');

        return view('principal/home', compact('sectores'));
    }

    function get_manzanas(){
        //$lotes = DB::select('select ST_AsGeoJSON(geom) geometry from espacial.manzanas');
/*
        $manzanas = DB::select(" SELECT json_build_object(
                'type',       'Feature',
                'id',         gid,
                'properties', json_build_object(
                   'gid', gid,
                    'cod_sect', cod_sect,
                    'cod_mza', cod_mza,
                    'mza_urb', mza_urb
                 ),
                 'geometry',   ST_AsGeoJSON(geom)::json
                  ) features
                  FROM espacial.manzanas limit 10;");*/


        $mznas = DB::connection('mapa')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id',         gid,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'gid', gid,
                                'mz_cat', mz_cat,
                                'mz_urb', mz_urb,
                                'sector_cat', sector_cat,
                                'aprobacion', aprobacion,
                                'cod_hab',cod_hab,
                                'nombre', nombre,
                                'jurisdicci', jurisdicci
                             )
                          ) AS feature
                          FROM (SELECT * FROM mdcc_2017.manzanas) row) features;");

        return response()->json($mznas);
    }
    function get_limites(){
        $limites = DB::connection('mapa')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id',         gid,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'gid', gid,
                                'layer', layer,
                                'doctype', doctype
                             )
                          ) AS feature
                          FROM (SELECT * FROM mdcc_2017.limites_distritales) row) features;");

        return response()->json($limites);
    }
    function get_sectores(){

        $sectores = DB::connection('mapa')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id',         gid,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'gid', gid,
                                'entity', entity,
                                'codigo', codigo,
                                'sector', sector
                             )
                          ) AS feature
                          FROM (SELECT * FROM mdcc_2017.sectores_cat) row) features;");

        return response()->json($sectores);
    }

    function get_centro_sector(Request $reques){
        //dd($reques->codigo);
        $centro_sector = DB::connection('mapa')->select("SELECT ST_X(ST_Centroid(ST_Transform (geom, 4326))) lat,ST_Y(ST_Centroid(ST_Transform (geom, 4326))) lon  from mdcc_2017.sectores_cat where codigo = '" . $reques->codigo . "'");
        return response()->json($centro_sector);
    }

    function mznas_x_sector(Request $req){
        $mznas=DB::connection('mapa')->select("SELECT gid, mz_cat FROM mdcc_2017.manzanas where sector_cat = '". $req->codigo."';");

        return view("principal/fpart/vw_select_mznas", compact('mznas'));
        //return view('catastro/vw_part_dlg_new_memoria_descriptiva', compact('mznas'));
    }

    function geogetmznas_x_sector(Request $req){
        $mznas = DB::connection('mapa')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id',         gid,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'gid', gid,
                                'mz_cat', mz_cat,
                                'mz_urb', mz_urb,
                                'sector_cat', sector_cat,
                                'aprobacion', aprobacion,
                                'cod_hab',cod_hab,
                                'nombre', nombre,
                                'jurisdicci', jurisdicci
                             )
                          ) AS feature
                          FROM (SELECT * FROM mdcc_2017.manzanas where sector_cat = '".$req->codigo."') row) features;");

        return response()->json($mznas);
    }
    
    public function nuevoUsuario(){
        return view('fnewUsuario');
    }
}
