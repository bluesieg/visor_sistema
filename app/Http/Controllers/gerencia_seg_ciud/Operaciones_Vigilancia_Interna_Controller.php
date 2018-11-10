<?php

namespace App\Http\Controllers\gerencia_seg_ciud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\gerencia_seg_ciud\Comisarias;
use App\Models\gerencia_seg_ciud\PersonalComisaria;
use App\Models\gerencia_seg_ciud\Observacion;
use App\Models\gerencia_seg_ciud\MapaDelito;
use App\Models\gerencia_seg_ciud\RutasSerenazgo;
use App\Models\gerencia_seg_ciud\ObservRutasSerenazgo;
use App\Models\gerencia_seg_ciud\PersonalRutaSerenazgo;


class Operaciones_Vigilancia_Interna_Controller extends Controller
{

    public function index(Request $request)
    {
        if ($request['tipo'] == 'comisarias') 
        {
            $tipo_persona = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.tipo_per')->get();
            return view('gerencia_seg_ciud/vw_comisarias',compact('tipo_persona'));
        }
        if ($request['tipo'] == 'mapa_delito') 
        {
            $tipo_delito = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.tipo_delito')->get();
            return view('gerencia_seg_ciud/vw_mapa_delito',compact('tipo_delito'));
        }
        if ($request['tipo'] == 'rutas_serenazgo') 
        { 
            $tipo_transporte = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.tipo_transporte')->get();
            return view('gerencia_seg_ciud/vw_rutas_serenazgo',compact('tipo_transporte'));
        }
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            if($request['show']=='comisarias')
            {
                return $this->traer_datos_comisarias($id);
            }
            if($request['show']=='personal_comisaria')
            {
                return $this->traer_datos_personal_comisarias($id);
            }
            if($request['show']=='datos_personal_comisaria')
            {
                return $this->traer_personal_comisarias($id);
            }
            if($request['show']=='datos_observacion_comisaria')
            {
                return $this->traer_observaciones_comisarias($id);
            }
            if($request['show']=='observaciones_comisarias')
            {
                return $this->traer_datos_observaciones_comisarias($id);
            }
            if($request['show']=='mapa_delito')
            {
                return $this->traer_datos_mapa_delito($id);
            }
            if($request['show']=='rutas_serenazgo')
            {
                return $this->traer_datos_rutas_serenazgo($id);
            }
            if($request['show']=='observaciones_rutas_serenazgo')
            {
                return $this->traer_datos_observaciones_rutas_serenazgo($id);
            }
            if($request['show']=='personal_rutas_serenazgo')
            {
                return $this->traer_datos_personal_rutas_serenazgo($id);
            }
        }
        else
        {
            if($request['reporte']=='comisarias')
            {
                return $this->abrir_reporte_comisarias($request);
            }
            if($request['reporte']=='mapa_delito')
            {
                return $this->abrir_reporte_mapa_delito($request);
            }
            if($request['reporte']=='semaforos')
            {
                return $this->abrir_reporte_semaforos($request);
            }
            if($request['grid']=='comisarias')
            {
                return $this->cargar_datos_comisarias($request['nombre']);
            }
            if ($request['grid'] == 'observaciones_comisarias') 
            {
                return $this->cargar_datos_observaciones_comisarias($request);
            }
            if ($request['grid'] == 'personal_comisaria') 
            {
                return $this->cargar_datos_personal_comisaria($request);
            }
            if($request['grid']=='mapa_delito')
            {
                return $this->cargar_datos_mapa_delito($request);
            }
            if($request['mapa']=='comisarias')
            {
                return $this->cargar_mapa_comisarias($request);
            }
            if($request['mapa']=='delitos')
            {
                return $this->cargar_mapa_delitos($request);
            }
            if($request['fotos']=='fotos_delitos')
            {
                return $this->cargar_fotos_mapa_delitos($request);
            }
            if($request['mapa']=='semaforos')
            {
                return $this->cargar_mapa_semaforos($request);
            }
            if($request['mapa']=='camaras')
            {
                return $this->cargar_mapa_camaras($request);
            }
            if($request['grid']=='rutas_serenazgo')
            {
                return $this->cargar_datos_rutas_serenazgo($request['ubicacion']);
            }
            if($request['grid']=='observaciones_rutas_serenazgo')
            {
                return $this->cargar_datos_observaciones_rutas_serenazgo($request);
            }
            if($request['grid']=='personal_rutas_serenazgo')
            {
                return $this->cargar_datos_personal_rutas_serenazgo($request);
            }
        }      
    }
    
    public function store(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->agregar_datos_personal_comisaria($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_datos_personal_comisaria($request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->editar_datos_comisaria($request);
        }
    }
    
    public function create(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->agregar_datos_observaciones_rutas_serenazgo($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->agregar_datos_personal_rutas_serenazgo($request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->agregar_datos_observaciones_comisarias($request);
        }
    }
    
    public function edit($id,Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->editar_datos_rutas_serenazgo($id, $request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_datos_observaciones_rutas_serenazgo($id, $request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->editar_datos_personal_rutas_serenazgo($id, $request);
        }
        if ($request['tipo'] == 4) 
        {
            return $this->editar_datos_mapa_delito($id, $request);
        }
        if ($request['tipo'] == 5) 
        {
            return $this->editar_datos_observaciones_comisarias($id, $request);
        }
        if ($request['tipo'] == 6) 
        {
            return $this->cambiar_estado_personal_comisaria($id, $request);
        }
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->eliminar_observaciones_rutas_serenazgo($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->eliminar_personal_rutas_serenazgo($request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->eliminar_observaciones_comisarias($request);
        }
        if ($request['tipo'] == 4) 
        {
            return $this->eliminar_personal_comisarias($request);
        }
    }

    public function traer_datos_dni($id)
    {
        $personas = DB::connection('gerencia_catastro')->table('public.personas')->where('pers_nro_doc',$id)->first();
        if(isset($personas)){
            return response()->json([
                    'nombre' => trim(str_replace('-','',$personas->pers_nombres)),
                    'apaterno' => trim(str_replace('-','',$personas->pers_ape_pat)),
                    'amaterno' => trim(str_replace('-','',$personas->pers_ape_mat)),
            ]);
        }
    }
    
    public function traer_datos_comisarias($id)
    {
        $comisarias = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisarias')->where('id',$id)->get();
        return $comisarias;
    }
    
    public function traer_datos_personal_comisarias($id)
    {
        $personal_comisaria = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.personal_comisaria')->where('id_personal_comisaria',$id)->get();
        return $personal_comisaria;
    }
    
    public function traer_personal_comisarias($id_comisaria)
    {
        $personales = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_personal_comisaria')->where("id_comisaria",$id_comisaria)->where('estado',1)->orderBy('id_personal_comisaria','desc')->get();
        if ($personales->count()) 
        {
            return $personales;
        }
        else
        {
            return 0;
        }
    }
    
    public function traer_observaciones_comisarias($id_comisaria)
    {
        $observaciones = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_comisaria')->where("id_comisaria",$id_comisaria)->orderBy('fecha_registro','desc')->get();
        if ($observaciones->count()) 
        {
            return $observaciones;
        }
        else
        {
            return 0;
        }
    }
    
    public function traer_datos_observaciones_comisarias($id)
    {
        $observaciones_comisarias = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_comisaria')->where('id_observacion',$id)->get();
        return $observaciones_comisarias;
    }
    
    public function traer_datos_mapa_delito($id)
    {
        $mapa_delito= DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_mapa_delito')->where('id_mapa_delito',$id)->get();
        return $mapa_delito;
    }
    
    public function traer_datos_rutas_serenazgo($id)
    {
        $rutas_serenazgo = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_rutas_serenazgo')->where('id_ruta_serenazgo',$id)->get();
        return $rutas_serenazgo;
    }
    
    public function traer_datos_observaciones_rutas_serenazgo($id)
    {
        $observaciones_rutas_serenazgo = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_ruta_serenazgo')->where('id_observ_ruta_srzgo',$id)->get();
        return $observaciones_rutas_serenazgo;
    }
    
    public function traer_datos_personal_rutas_serenazgo($id)
    {
        $personal_rutas_serenazgo = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.personal_ruta_serenazgo')->where('id_per_ruta_serenazgo',$id)->get();
        return $personal_rutas_serenazgo;
    }
    
    public function agregar_datos_observaciones_rutas_serenazgo(Request $request)
    {
        $ObservRutasSerenazgo = new ObservRutasSerenazgo;
        $ObservRutasSerenazgo->id_ruta_serenazgo = $request['id_ruta_serenazgo'];
        $ObservRutasSerenazgo->fecha_registro    = date('d-m-Y');
        $ObservRutasSerenazgo->observaciones     = strtoupper($request['observaciones']); 
        $ObservRutasSerenazgo->usuario           = Auth::user()->id;
        
        $ObservRutasSerenazgo->save();
        return $ObservRutasSerenazgo->id_observ_ruta_srzgo;
    }
    
    public function agregar_datos_personal_rutas_serenazgo(Request $request)
    {
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.personal_ruta_serenazgo')->where('dni',$request['dni'])->get();

        if ($sql->count()) 
        {
            return 0;
        }
        else
        {
            $PersonalRutaSerenazgo = new PersonalRutaSerenazgo;
            $PersonalRutaSerenazgo->id_ruta_serenazgo = $request['id_ruta_serenazgo'];
            $PersonalRutaSerenazgo->nombres     = strtoupper($request['nombres']);
            $PersonalRutaSerenazgo->ape_pat     = strtoupper($request['apaterno']);
            $PersonalRutaSerenazgo->ape_mat     = strtoupper($request['amaterno']);
            $PersonalRutaSerenazgo->fec_reg     = date('d-m-Y');
            $PersonalRutaSerenazgo->usuario     = Auth::user()->id;
            $PersonalRutaSerenazgo->dni         = $request['dni'];
            $PersonalRutaSerenazgo->telefono    = $request['telefono'];

            $PersonalRutaSerenazgo->save();
            return $PersonalRutaSerenazgo->id_per_ruta_serenazgo;
        }
    }
    
    public function agregar_datos_observaciones_comisarias(Request $request)
    {
        $Observacion = new Observacion;
        $Observacion->observacion       = strtoupper($request['observaciones']);
        $Observacion->fecha             = date('d-m-Y');
        $Observacion->id_usuario        = Auth::user()->id;
        $Observacion->id_comisaria      = $request['id_comisaria'];
        $Observacion->fecha_registro    = $request['fecha_registro'];
        
        $Observacion->save();
        return $Observacion->id_observacion;
    }
    
    public function agregar_datos_personal_comisaria(Request $request)
    {
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.personal_comisaria')->where('dni',$request['dlg_dni'])->get();

        if ($sql->count()) 
        {
            return 0;
        }
        else
        {
            $file = $request->file('dlg_foto_persona');
            $PersonalComisaria = new PersonalComisaria;
            $PersonalComisaria->dni           = $request['dlg_dni'];
            $PersonalComisaria->nombre        = strtoupper($request['dlg_nombres']);
            $PersonalComisaria->apaterno      = strtoupper($request['dlg_apaterno']);
            $PersonalComisaria->amaterno      = strtoupper($request['dlg_amaterno']);
            $PersonalComisaria->telefono      = $request['dlg_telefono'];
            $PersonalComisaria->tipo_per      = $request['dlg_tipo_persona'];
            $PersonalComisaria->tipo_per = 1;

            if ($file) {
                $file_1 = \File::get($file);
                $PersonalComisaria->foto = base64_encode($file_1);
            }else{
                $PersonalComisaria->foto = "";
            }

            $PersonalComisaria->id_usuario = Auth::user()->id;
            $PersonalComisaria->estado  = 1;
            $PersonalComisaria->id_comisaria  = $request['id_comisaria'];
            $PersonalComisaria->fecha_registro = date('d-m-Y');
            $PersonalComisaria->save();

            return $PersonalComisaria->id_personal_comisaria;
        }
    }
    
    public function editar_datos_personal_comisaria(Request $request)
    {
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.personal_comisaria')->where('dni',$request['dlg_dni'])->where('id_personal_comisaria','<>',$request['id_personal_comisaria'])->get();

        if ($sql->count()) 
        {
            return 0;
        }
        else
        {
            $file = $request->file('dlg_foto_persona');
            $PersonalComisaria = new PersonalComisaria;
            $val=  $PersonalComisaria::where("id_personal_comisaria","=",$request['id_personal_comisaria'])->first();
            if($val)
            {
                $val->dni           = $request['dlg_dni'];
                $val->nombre        = strtoupper($request['dlg_nombres']);
                $val->apaterno      = strtoupper($request['dlg_apaterno']);
                $val->amaterno      = strtoupper($request['dlg_amaterno']);
                $val->telefono      = $request['dlg_telefono'];
                $val->tipo_per      = $request['dlg_tipo_persona'];

                if ($file) 
                {
                    $file_1 = \File::get($file);
                    $val->foto = base64_encode($file_1);
                }

                $val->id_usuario     = Auth::user()->id;
                $val->save();
            }
            return $val->id_personal_comisaria;   
        }
    }
    
    public function editar_datos_comisaria(Request $request)
    {
        $file = $request->file('dlg_foto_comisaria');
        $Comisarias = new Comisarias;
        $val=  $Comisarias::where("id","=",$request['id_comisaria'])->first();
        if($val->count())
        {
            $val->nombre = strtoupper($request['dlg_nombre_comisaria']);
            $val->ubicacion = strtoupper($request['dlg_ubicacion']);
            $val->telefono = $request['dlg_telefono_comisaria'];
            $val->nro_efectivos = $request['dlg_nro_efectivos'];
            $val->nro_vehiculos = $request['dlg_nro_vehiculos'];

            if ($file) 
            {
                $file_1 = \File::get($file);
                $val->foto = base64_encode($file_1);
            }

            $val->id_usuario = Auth::user()->id;

            $val->save();
        }
        return $val->id;
    }
    
    public function editar_datos_observaciones_comisarias($id_observacion, Request $request)
    {
        $Observacion = new Observacion;
        $val=  $Observacion::where("id_observacion","=",$id_observacion )->first();
        if($val)
        {
            $val->observacion      = strtoupper($request['observaciones']);
            $val->fecha            = date('d-m-Y');
            $val->id_usuario       = Auth::user()->id;
            $val->fecha_registro   = $request['fecha_registro'];
            $val->save();
        }
        return $id_observacion;
    }
    
    public function editar_datos_rutas_serenazgo($id_ruta_serenazgo, Request $request)
    {
        $RutasSerenazgo = new RutasSerenazgo;
        $val=  $RutasSerenazgo::where("id_ruta_serenazgo","=",$id_ruta_serenazgo )->first();
        if($val)
        {
            $val->ubicacion             = strtoupper($request['ubicacion']);
            $val->unidad                = strtoupper($request['unidad']);
            $val->placa                 = strtoupper($request['placa']);
            $val->id_tipo_transporte    = $request['tipo_transporte'];
            $val->personal              = $request['tipo_personal'];
            $val->save();
        }
        return $id_ruta_serenazgo;
    }
    
    public function editar_datos_observaciones_rutas_serenazgo($id_observ_ruta_srzgo, Request $request)
    {
        $ObservRutasSerenazgo = new ObservRutasSerenazgo;
        $val=  $ObservRutasSerenazgo::where("id_observ_ruta_srzgo","=",$id_observ_ruta_srzgo )->first();
        if($val)
        {
            $val->observaciones      = strtoupper($request['observaciones']);
            $val->usuario            = Auth::user()->id;
            $val->save();
        }
        return $id_observ_ruta_srzgo;
    }
    
    public function editar_datos_personal_rutas_serenazgo($id_per_ruta_serenazgo, Request $request)
    {
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.personal_ruta_serenazgo')->where('dni',$request['dni'])->where('id_per_ruta_serenazgo','<>',$id_per_ruta_serenazgo)->get();

        if ($sql->count()) 
        {
            return 0;
        }
        else
        {
            $PersonalRutaSerenazgo = new PersonalRutaSerenazgo;
            $val=  $PersonalRutaSerenazgo::where("id_per_ruta_serenazgo","=",$id_per_ruta_serenazgo )->first();
            if($val)
            {
                $val->id_ruta_serenazgo = $request['id_ruta_serenazgo'];
                $val->dni          = $request['dni'];
                $val->nombres      = strtoupper($request['nombres']);
                $val->ape_pat      = strtoupper($request['apaterno']);
                $val->ape_mat      = strtoupper($request['amaterno']);
                $val->usuario      = Auth::user()->id;
                $val->telefono     = $request['telefono'];
                $val->save();
            }
            return $id_per_ruta_serenazgo;
        }
    }
    
    public function editar_datos_mapa_delito($id_mapa_delito, Request $request)
    {
        $MapaDelito = new MapaDelito;
        $val=  $MapaDelito::where("id_mapa_delito","=",$id_mapa_delito )->first();
        if($val)
        {
            $val->ubicacion = strtoupper($request['ubicacion']);
            $val->id_tipo_delito = $request['tipo_delito'];
            $val->id_pers_infractor = $request['infractor'];
            $val->id_pers_encargado = $request['encargado'];
            $val->vehiculo = strtoupper($request['vehiculo']);
            $val->observacion = strtoupper($request['observacion']);
            
            $val->save();
        }
        return $id_mapa_delito;
    }
    
    public function cambiar_estado_personal_comisaria($id_personal_comisaria, Request $request)
    {
        $PersonalComisaria = new PersonalComisaria;
        $val = $PersonalComisaria::where("id_personal_comisaria","=",$id_personal_comisaria)->where('id_comisaria',$request['id_comisaria'])->first();
        if($val)
        {
            $val->estado      = $request['estado'];
            $val->fecha_final = date('d-m-Y');
            $val->id_usuario  = Auth::user()->id;
            $val->save();
        }
        return $id_personal_comisaria;
    }
    
    public function cargar_datos_comisarias($nombre)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_comisarias where nombre like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisarias')->where('nombre','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id),
                trim($Datos->nombre),
                trim($Datos->telefono),
                trim($Datos->nro_vehiculos),
                trim($Datos->nro_efectivos),
                trim($Datos->ubicacion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_observaciones_comisarias(Request $request)
    {
        header('Content-type: application/json');
        $indice = $request['indice'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if ($indice == 0) {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_comisaria where id_comisaria = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_comisaria')->where('id_comisaria',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_comisaria where id_comisaria = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_comisaria')->where('id_comisaria',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
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
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id_observacion;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_observacion),
                trim($Datos->fecha_registro),
                trim($Datos->observacion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_personal_comisaria(Request $request)
    {
        header('Content-type: application/json');
        $indice = $request['indice'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if ($indice == 0) {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_personal_comisaria where id_comisaria = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_personal_comisaria')->where('id_comisaria',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_personal_comisaria where id_comisaria = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_personal_comisaria')->where('id_comisaria',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
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
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id_personal_comisaria;
            if ($Datos->estado == 1) {
              $nuevo = '<button class="btn btn-labeled btn-success" type="button" onclick="Cambiar_estado('.trim($Datos->id_personal_comisaria).','.trim($Datos->id_comisaria).',0)"><span class="btn-label"><i class="fa fa-plus"></i></span> ACTIVO</button>';
            }else{
               $nuevo = '<button class="btn btn-labeled btn-danger" type="button" onclick="Cambiar_estado('.trim($Datos->id_personal_comisaria).','.trim($Datos->id_comisaria).',1)"><span class="btn-label"><i class="fa fa-trash"></i></span> INACTIVO</button>'; 
            }            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_personal_comisaria),
                trim($Datos->dni),
                trim($Datos->persona),
                trim($Datos->telefono),
                trim($Datos->descripcion),
                trim($Datos->fecha_registro),
                $nuevo,
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_mapa_delito(Request $request)
    {
        header('Content-type: application/json');
        $data = $request['data'];
        $fecha_inicio = $request['fecha_inicio'];
        $fecha_fin = $request['fecha_fin'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if ($data == '0') 
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_mapa_delito");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_mapa_delito')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_mapa_delito where fecha_registro between '$fecha_inicio' and '$fecha_fin'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_mapa_delito')->whereBetween('fecha_registro', [$fecha_inicio, $fecha_fin])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
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
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id_mapa_delito;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_mapa_delito),
                trim($Datos->infractor),
                trim($Datos->descripcion),
                trim($Datos->ubicacion),
                trim($Datos->fecha_registro),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_rutas_serenazgo($ubicacion)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_rutas_serenazgo where ubicacion like '%".strtoupper($ubicacion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_rutas_serenazgo')->where('ubicacion','like', '%'.strtoupper($ubicacion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id_ruta_serenazgo;  
            if ($Datos->personal == '1') {
              $nuevo = "SERENAZGO";
            }else{
              $nuevo = "INTEGRADO";
            }
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_ruta_serenazgo),
                trim($Datos->ubicacion),
                trim($Datos->unidad),
                trim($Datos->placa),
                $nuevo,
                trim($Datos->descripcion),    
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_observaciones_rutas_serenazgo(Request $request)
    {
        header('Content-type: application/json');
        $indice = $request['indice'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if ($indice == 0) {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_ruta_serenazgo where id_ruta_serenazgo = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_ruta_serenazgo')->where('id_ruta_serenazgo',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_ruta_serenazgo where id_ruta_serenazgo = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_ruta_serenazgo')->where('id_ruta_serenazgo',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
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
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id_observ_ruta_srzgo;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_observ_ruta_srzgo),
                trim($Datos->fecha_registro),
                trim($Datos->observaciones),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_personal_rutas_serenazgo(Request $request)
    {
        header('Content-type: application/json');
        $indice = $request['indice'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if ($indice == 0) {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_personal_ruta_serenazgo where id_ruta_serenazgo = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_personal_ruta_serenazgo')->where('id_ruta_serenazgo',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_personal_ruta_serenazgo where id_ruta_serenazgo = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_personal_ruta_serenazgo')->where('id_ruta_serenazgo',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
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
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id_per_ruta_serenazgo;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_per_ruta_serenazgo),
                trim($Datos->dni),
                trim($Datos->persona),
                trim($Datos->fec_reg),
                trim($Datos->telefono),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_mapa_comisarias(){

        $comisarias = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'nombre',nombre,
                                'id',id,
                                'x',x,
                                'y',y,
                                'ubicacion',ubicacion,
                                'nro_efectivos',nro_efectivos,
                                'nro_vehiculos',nro_vehiculos,
                                'telefono',telefono,
                                'foto',foto,
                                'fecha_registro',fecha_registro
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_seg_ciudadana.comisarias) row) features;");

        return response()->json($comisarias);
      
    }
    
    public function cargar_mapa_semaforos()
    {
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_seg_ciudadana.vw_semaforos");
        
        if($sql)
        {
            $semaforos = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                                'type',     'FeatureCollection',
                                'features', json_agg(feature)
                            )
                            FROM (
                              SELECT json_build_object(
                                'type',       
                                'Feature',
                                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                                'properties', json_build_object(
                                    'id_semaforo',id_semaforo,
                                    'ubicacion',ubicacion,
                                    'cod_semaforo',cod_semaforo,
                                    'tipo_semaforo',tipo_semaforo,
                                    'peatonal',peatonal,
                                    'cod_controlador',cod_controlador,
                                    'controlador',controlador,
                                    'imagen',imagen,
                                    'estado',estado
                                 )
                              ) AS feature
                              FROM (SELECT * FROM geren_seg_ciudadana.vw_semaforos) row) features;");

            return response()->json($semaforos);
        }
        else
        {
            return 0; 
        }
    }
    
    public function cargar_mapa_delitos()
    {
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_seg_ciudadana.vw_mapa_delito");
        
        if($sql)
        {
            $delitos = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                                'type',     'FeatureCollection',
                                'features', json_agg(feature)
                            )
                            FROM (
                              SELECT json_build_object(
                                'type',       
                                'Feature',
                                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                                'properties', json_build_object(
                                    'id_mapa_delito',id_mapa_delito,
                                    'nro_doc_infractor',nro_doc_infractor,
                                    'infractor',infractor,
                                    'nro_doc_encargado',nro_doc_encargado,
                                    'encargado',encargado,
                                    'descripcion',descripcion,
                                    'ubicacion',ubicacion,
                                    'fecha_registro',fecha_registro,
                                    'observacion',observacion,
                                    'vehiculo',vehiculo
                                 )
                              ) AS feature
                              FROM (SELECT id_mapa_delito,geom,nro_doc_infractor,infractor,nro_doc_encargado,encargado,descripcion,ubicacion,fecha_registro,observacion,vehiculo FROM geren_seg_ciudadana.vw_mapa_delito) row) features;");

            return response()->json($delitos);
        }
        else
        {
            return 0; 
        }    
    }
    
    public function cargar_mapa_camaras()
    {
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_seg_ciudadana.camaras");
        
        if($sql)
        {
            $camaras = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_camara',id_camara,
                                'imagen',imagen,
                                'observacion',observacion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_seg_ciudadana.camaras) row) features;");

            return response()->json($camaras);
        }
        else
        {
            return 0; 
        }
    }
    
    public function cargar_fotos_mapa_delitos(Request $request){
        $id_mapa_delito = $request['id_mapa_delito'];
        $foto = DB::connection('gerencia_catastro')->select("select imagen from geren_seg_ciudadana.mapa_delito where id_mapa_delito = $id_mapa_delito");
        if($foto)
        {
            return $foto;
        }
        else
        {
            return 0; 
        }
    }
    
    public function abrir_reporte_comisarias(Request $request)
    { 
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_comisarias')->where('id',$request['id_comisaria'])->first();
        $observaciones = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_comisaria')->where('id_comisaria',$sql->id)->get();
        $personal = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_personal_comisaria')->where('estado',1)->where('id_comisaria',$sql->id)->get();
        
        if($sql)
        {
            $view =  \View::make('gerencia_seg_ciud.reportes.reporte_comisarias', compact('sql','observaciones','personal'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("REPORTE COMISARIA".".pdf");
        }
        else
        {   return 'No hay datos';}
    }
    
    public function abrir_reporte_mapa_delito(Request $request)
    { 
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_mapa_delito')->where('id_mapa_delito',$request['id_mapa_delito'])->first();
        
        if($sql)
        {
            $view =  \View::make('gerencia_seg_ciud.reportes.reporte_mapa_delito', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("REPORTE MAPA DELITO".".pdf");
        }
        else
        {   return 'No hay datos';}
    }
    
    public function abrir_reporte_semaforos(Request $request)
    { 
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_semaforos')->where('id_semaforo',$request['id_semaforo'])->first();
        $observaciones = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_semaforos')->where('id_semaforo',$sql->id_semaforo)->get();
        
        if($sql)
        {
            $view =  \View::make('gerencia_seg_ciud.reportes.reporte_semaforos', compact('sql','observaciones'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("REPORTE SEMAFOROS".".pdf");
        }
        else
        {   return 'No hay datos';}
    }
    
    public function eliminar_observaciones_comisarias(Request $request)
    {
        $Observacion = new  Observacion;
        $val=  $Observacion::where("id_observacion","=",$request['id_observacion'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observacion'];
    }
    
    public function eliminar_observaciones_rutas_serenazgo(Request $request)
    {
        $ObservRutasSerenazgo = new  ObservRutasSerenazgo;
        $val=  $ObservRutasSerenazgo::where("id_observ_ruta_srzgo","=",$request['id_observ_ruta_srzgo'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observ_ruta_srzgo'];
    }
    
    public function eliminar_personal_rutas_serenazgo(Request $request)
    {
        $PersonalRutaSerenazgo = new  PersonalRutaSerenazgo;
        $val=  $PersonalRutaSerenazgo::where("id_per_ruta_serenazgo","=",$request['id_per_ruta_serenazgo'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_per_ruta_serenazgo'];
    }
    
    public function eliminar_personal_comisarias(Request $request)
    {
        $PersonalComisaria = new  PersonalComisaria;
        $val=  $PersonalComisaria::where("id_personal_comisaria","=",$request['id_personal_comisaria'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_personal_comisaria'];
    }
    
}
