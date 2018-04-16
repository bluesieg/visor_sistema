<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\planeamiento_hab_urb\Insp_Campo;

class Insp_CampoController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        $datos = new  Insp_Campo;
        $datos->id_reg_exp = $request['id_reg_exp'];
        $datos->fch_inspeccion = $request['fch_inspeccion'];
        $datos->tipo_suelo = $request['tipo_suelo'];
        $datos->zonificacion = $request['zonificacion'];
        $datos->planos_mpa = $request['planos_mpa'];
        $datos->res_habil_urbana = $request['res_habil_urbana'];
        $datos->nro_de_personas = $request['nro_de_personas'];
        $datos->nro_de_habitaciones = $request['nro_de_habitaciones'];
        $datos->f_a_tarima = $request['f_a_tarima'];
        $datos->f_a_colchon = $request['f_a_colchon'];
        $datos->f_a_comoda = $request['f_a_comoda'];
        $datos->f_a_ropero = $request['f_a_ropero'];
        $datos->f_a_ropa_canasto = $request['f_a_ropa_canasto'];
        $datos->f_a_aparador = $request['f_a_aparador'];
        $datos->f_a_televisor = $request['f_a_televisor'];
        $datos->f_a_radio_e_sonido = $request['f_a_radio_e_sonido'];
        $datos->f_c_cocina = $request['f_c_cocina'];
        $datos->f_c_balon_gas = $request['f_c_balon_gas'];
        $datos->f_c_mesas = $request['f_c_mesas'];
        $datos->f_c_sillas = $request['f_c_sillas'];
        $datos->f_c_viveres = $request['f_c_viveres'];
        $datos->f_c_ollas = $request['f_c_ollas'];
        $datos->f_c_repostero = $request['f_c_repostero'];
        $datos->f_c_servicios = $request['f_c_servicios'];
        $datos->f_p_baldes_lavadores = $request['f_p_baldes_lavadores'];
        $datos->fp_bidones_agua = $request['fp_bidones_agua'];
        $datos->f_p_lavatorio = $request['f_p_lavatorio'];
        $datos->f_p_corral_mascotas = $request['f_p_corral_mascotas'];
        $datos->f_p_plantas = $request['f_p_plantas'];
        $datos->f_p_silo = $request['f_p_silo'];
        $datos->f_p_bano = $request['f_p_bano'];
        $datos->g_area_aprox = $request['g_area_aprox'];
        $datos->g_lin_rec_frent = $request['g_lin_rec_frent'];
        $datos->g_lin_rec_derecha = $request['g_lin_rec_derecha'];
        $datos->g_lin_rec_izq = $request['g_lin_rec_izq'];
        $datos->g_lin_rec_fondo = $request['g_lin_rec_fondo'];
        $datos->por_el_frente = $request['por_el_frente'];
        $datos->por_la_derecha = $request['por_la_derecha'];
        $datos->por_la_izquierda = $request['por_la_izquierda'];
        $datos->por_el_fondo = $request['por_el_fondo'];
        $datos->observaciones = $request['observaciones'];
        $datos->vecin_01_apenom = $request['vecin_01_apenom'];
        $datos->vecin_01_dni = $request['vecin_01_dni'];
        $datos->vecin_01_direcc = $request['vecin_01_direcc'];
        $datos->vecin_02_apenom = $request['vecin_02_apenom'];
        $datos->vecin_02_dni = $request['vecin_02_dni'];
        $datos->vecin_02_direcc = $request['vecin_02_direcc'];
        $datos->vecin_03_apenom = $request['vecin_03_apenom'];
        $datos->vecin_03_dni = $request['vecin_03_dni'];
        $datos->vecin_03_dni = $request['vecin_03_dni'];
        $datos->vecin_03_direcc = $request['vecin_03_direcc'];
        $datos->tipo_cerco1 = $request['tipo_cerco1'];
        $datos->tipo_cerco2 = $request['tipo_cerco2'];
        $datos->tipo_cerco3 = $request['tipo_cerco3'];
        $datos->tipo_cerco4 = $request['tipo_cerco4'];
        $datos->tipo_cerco5 = $request['tipo_cerco5'];
        $datos->tipo_cerco6 = $request['tipo_cerco6'];
        $datos->habitacion1 = $request['habitacion1'];
        $datos->habitacion2 = $request['habitacion2'];
        $datos->habitacion3 = $request['habitacion3'];
        $datos->habitacion4 = $request['habitacion4'];
        $datos->habitacion5 = $request['habitacion5'];
        $datos->habitacion6 = $request['habitacion6'];
        $datos->tipo_de_techo1 = $request['tipo_de_techo1'];
        $datos->tipo_de_techo2 = $request['tipo_de_techo2'];
        $datos->tipo_de_techo3 = $request['tipo_de_techo3'];
        $datos->servicios1 = $request['servicios1'];
        $datos->servicios2 = $request['servicios2'];
        $datos->servicios3 = $request['servicios3'];
        $datos->servicios4 = $request['servicios4'];
        $datos->save();
        return $datos->ide;

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

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
}
