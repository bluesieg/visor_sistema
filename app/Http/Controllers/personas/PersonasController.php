<?php

namespace App\Http\Controllers\personas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\personas\Personas;


class PersonasController extends Controller
{

    public function index(Request $request)
    {
    
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            if ($request['show']=='recuperar_dni') 
            {
                return $this->traer_datos_dni($id);
            } 
        }
        else
        {
            if($request['datos']=='buscar_datos_reniec')
            {
                return $this->buscar_datos_reniec($request);
            }
        }
    }
    
    public function store(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->guardar_datos_persona($request);
        }
    }
    
    public function create(Request $request)
    {
        
    }
    
    public function edit(Request $request)
    {
       
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
      
    }
    
    public function traer_datos_dni($id)
    {
        $personas = DB::connection('gerencia_catastro')->table('public.personas')->where('pers_nro_doc',$id)->first();
        if(isset($personas)){
            return response()->json([
                'id_pers' => $personas->id_pers,
                'nombre' => trim(str_replace('-','',$personas->pers_nombres)),
                'apaterno' => trim(str_replace('-','',$personas->pers_ape_pat)),
                'amaterno' => trim(str_replace('-','',$personas->pers_ape_mat)),
            ]);
        }
    }
    
    public function buscar_datos_reniec(Request $request)
    { 
        $rq		= new \stdClass();
        $rq->data	= new \stdClass();
        $rq->auth	= new \stdClass();

        $rq->auth->dni	= '29627950';		// DNI del usuario
        $rq->auth->pas	= 'Mie1974';           // Contrasenia
        $rq->auth->ruc	= '20159515240';	// RUC de la entida del usuario

        $rq->data->ws	= 'getDatosDni';	// Web Service al que se va a llamar
        $rq->data->dni	= $request['nro_doc'];		// Dato que debe estar acorde al contrato del ws
        $rq->data->cache= 'false';		// Retira informacion del Cache local (true mejora la velocidad de respuesta

        //$url = 'https://ehg.pe/delfos/';		// Endpoint del WS
         //  $url = 'http://ws.ehg.pe/';
       $url = 'http://10.11.10.104/';
        $options = array(
                'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',                
                'content' => json_encode($rq)
            )
        );

        $context  = stream_context_create($options);

        $result = file_get_contents($url, false, $context);

        if ($result === FALSE){  
          echo 'Error de conexion';
        }

        $rpta = json_decode($result);

        if($rpta->resp->code == '0000'){
            $Lista=new \stdClass();
            $Lista->ape_pat=$rpta->data->apPrimer;
            $Lista->ape_mat=$rpta->data->apSegundo;
            $Lista->nombres=$rpta->data->prenombres;
            $Lista->est_civil=$rpta->data->estadoCivil;
            $Lista->dir=$rpta->data->direccion;
            $Lista->ubigeo=$rpta->data->ubigeo;
//            $Lista->foto='http://ws.ehg.pe'.$rpta->data->foto;
            $Lista->foto='http://10.11.10.104'.$rpta->data->foto;
            return response()->json($Lista);
        }
    }
    
    public function guardar_datos_persona(Request $request)
    {
        $Personas = new Personas();
        $Personas->pers_ape_pat = strtoupper($request['pers_ape_pat']);
        $Personas->pers_ape_mat = strtoupper($request['pers_ape_mat']);
        $Personas->pers_nombres = strtoupper($request['pers_nombres']);
        $Personas->pers_raz_soc = $request['pers_raz_soc'];
        $Personas->pers_tip_doc = $request['pers_tip_doc'];
        $Personas->pers_nro_doc = $request['pers_nro_doc'];
        $Personas->pers_sexo = $request['pers_sexo'];
        $Personas->pers_fnac = date('Y-m-d', strtotime($request['pers_fnac']));
        $image=$request['pers_foto'];
        $img_file = file_get_contents($image);
        $Personas->pers_foto = base64_encode($img_file);
        $Personas->fec_reg = date('d-m-Y');
        $Personas->usuario = Auth::user()->id;
        $Personas->save();

        return response()->json([
            'id_pers' => $Personas->id_pers,
            'nombre' => trim(str_replace('-','',$Personas->pers_nombres)),
            'apaterno' => trim(str_replace('-','',$Personas->pers_ape_pat)),
            'amaterno' => trim(str_replace('-','',$Personas->pers_ape_mat)),
        ]);
    }
    
}