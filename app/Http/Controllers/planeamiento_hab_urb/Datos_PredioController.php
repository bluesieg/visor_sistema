<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\planeamiento_hab_urb\Datos_Predio;
use Illuminate\Support\Facades\DB;
use App\Traits\DatesTranslator;
class Datos_PredioController extends Controller
{
  
    use DatesTranslator;
    public function index(Request $request)
    {
        if($request['grid']=='1')
        {
            return $this->cargar_datos_predio($request);
        }
        if($request['grid']=='2')
        {
            return $this->cargar_datos_vw_asig_exped($request);
        }
        if($request['grid']=='3')
        {
            return $this->cargar_datos_vw_vistos_legales($request);
        }
         if($request['grid']=='4')
        {
            return $this->cargar_datos_vw_vistos_y_firmas($request);
        }
         if($request['grid']=='5')
        {
            return $this->cargar_datos_vw_entrega_cons($request);
        }
         if($request['grid']=='9')
        {
            return $this->cargar_constancias_entregadas($request);
        }
         if($request['grid']=='9_1')
        {
            return $this->cargar_documetos($request);
        }
    }
    public function cargar_datos_predio(Request $request)
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

             $totalg = DB::connection('gerencia_catastro')->select("select count(id_reg_exp) as total from soft_const_posesion.vw_reg_datos_lote");
             $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_reg_datos_lote')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
                $Lista->rows[$Index]['id'] = $Datos->id_dat_predio;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_dat_predio),
                    trim($Datos->anio),
                    trim($Datos->nro_expediente),
                    trim($Datos->gestor),
                    trim($Datos->nomb_hab_urba),
                    trim($this->getCreatedAtAttribute($Datos->fecha_inicio_tramite)->format('d/m/Y')),
                );
            }
            return response()->json($Lista);
    }
    public function cargar_datos_vw_asig_exped(Request $request)
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

             $totalg = DB::connection('gerencia_catastro')->select("select count(id_asig_exp) as total from soft_const_posesion.vw_reg_insp_campo");
             $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_reg_insp_campo')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
                $btn="";
                if($Datos->ide>0)
                {
                    $btn='<button class="btn btn-labeled bg-color-greenDark txt-color-white" type="button" onclick="envia_verificacion('.trim($Datos->id_reg_exp).')"><span class="btn-label"><i class="fa fa-edit"></i></span> Env. Verif. Tecnica</button>';
                }
                $Lista->rows[$Index]['id'] = $Datos->id_asig_exp;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_asig_exp),
                    trim($Datos->id_reg_exp),
                    trim($Datos->ide),
                    trim($Datos->nro_expediente),
                    trim($Datos->gestor),
                    trim($Datos->nomb_hab_urba),
                    trim($this->getCreatedAtAttribute($Datos->fec_asig)->format('d/m/Y')),
                    trim($this->getCreatedAtAttribute($Datos->fch_inspeccion)->format('d/m/Y')),
                    $btn,
                );
            }
            return response()->json($Lista);
    }
    public function cargar_datos_vw_vistos_legales(Request $request)
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

             $totalg = DB::connection('gerencia_catastro')->select("select count(id_reg_exp) as total from soft_const_posesion.vw_exped_para_visto_legal");
             $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_exped_para_visto_legal')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
                $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_reg_exp),
                    trim($Datos->nro_expediente),
                    trim($Datos->gestor),
                    trim($this->getCreatedAtAttribute($Datos->fecha_registro)->format('d/m/Y')),
                     trim($this->getCreatedAtAttribute($Datos->fch_inspeccion)->format('d/m/Y')),
                );
            }
            return response()->json($Lista);
    }
       public function cargar_datos_vw_vistos_y_firmas(Request $request)
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

             $totalg = DB::connection('gerencia_catastro')->select("select count(id_reg_exp) as total from soft_const_posesion.vw_exped_para_visto_firma");
             $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_exped_para_visto_firma')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
                $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_reg_exp),
                    trim($Datos->nro_expediente),
                    trim($Datos->gestor),
                    trim($this->getCreatedAtAttribute($Datos->fecha_registro)->format('d/m/Y')),
                     trim($this->getCreatedAtAttribute($Datos->fch_inspeccion)->format('d/m/Y')),
                );
            }
            return response()->json($Lista);
    }
      public function cargar_datos_vw_entrega_cons(Request $request)
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

             $totalg = DB::connection('gerencia_catastro')->select("select count(id_reg_exp) as total from soft_const_posesion.vw_entrega_constancias");
             $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_entrega_constancias')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
                $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_reg_exp),
                    trim($Datos->nro_expediente),
                    trim($Datos->gestor),
                    trim($this->getCreatedAtAttribute($Datos->fecha_registro)->format('d/m/Y')),
                );
            }
            return response()->json($Lista);
    }
    public function cargar_constancias_entregadas(Request $request)
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

             $totalg = DB::connection('gerencia_catastro')->select("select count(id_reg_exp) as total from soft_const_posesion.vw_constancias_entregadas");
             $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_constancias_entregadas')->whereBetween('fecha_entrega',[$request['fecini'], $request['fecfin']])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
                $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_reg_exp),
                    trim($Datos->nro_expediente),
                    trim($Datos->gestor),
                    trim($Datos->nro_constancia),
                    trim($this->getCreatedAtAttribute($Datos->fecha_entrega)->format('d/m/Y')),
                    '<button class="btn btn-labeled bg-color-greenDark txt-color-white" type="button" onclick="subir_scan('.trim($Datos->id_reg_exp).')"><span class="btn-label"><i class="fa fa-print"></i></span> SUBIR ESCANEO</button>'
                );
            }
            return response()->json($Lista);
    }
    public function cargar_documetos(Request $request)
    {
             return DB::connection('gerencia_catastro')->select("select * from plan_constancias.vw_constancias_2015 where id_const=".$request['id']);
        
//            header('Content-type: application/json');
//            $page = $_GET['page'];
//            $limit = $_GET['rows'];
//            $sidx = $_GET['sidx'];
//            $sord = $_GET['sord'];
//            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
//            if ($start < 0) {
//                $start = 0;
//            }
//
//             $totalg = DB::connection('gerencia_catastro')->select("select count(id_reg_exp) as total from soft_const_posesion.vw_doc_adjuntos where id_reg_exp=".$request['id']);
//             $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_doc_adjuntos')->where('id_reg_exp',$request['id'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
//                    
//            $total_pages = 0;
//            if (!$sidx) {
//                $sidx = 1;
//            }
//            $count = $totalg[0]->total;
//            if ($count > 0) {
//                $total_pages = ceil($count / $limit);
//            }
//            if ($page > $total_pages) {
//                $page = $total_pages;
//            }
//            $Lista = new \stdClass();
//            $Lista->page = $page;
//            $Lista->total = $total_pages;
//            $Lista->records = $count;
//            foreach ($sql as $Index => $Datos) {                
//                $Lista->rows[$Index]['id'] = $Datos->id_doc_adj;            
//                $Lista->rows[$Index]['cell'] = array(
//                    trim($Datos->id_doc_adj),
//                    trim($Datos->t_documento),
//                    trim($Datos->descripcion),
//                    '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver</button>',
//                    '<button class="btn btn-labeled btn-danger" type="button" onclick="delfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-trash"></i></span> Borrar</button>',
//                );
//            }
//            return response()->json($Lista);
    }


    public function create(Request $request)
    {
        $datos = new  Datos_Predio;
        $datos->id_reg_exp = $request['cod'];
        $datos->id_lote = $request['id_lote'];
        $datos->sector = $request['sector'];
        //$datos->id_hab_urb = $request['zona'];
        $datos->sup_mzna = $request['sup_mzna'];
        $datos->mzna = $request['mzna'];
        $datos->lote = $request['lote'];
        $datos->sub_lote = $request['sub_lote'];
        $datos->anio_posesion = $request['anio'];
        $datos->area_m2 = $request['area'];
        $datos->frente = $request['frente'];
        $datos->con_01 = $request['frente_con'];
        $datos->derecho = $request['derecho'];
        $datos->con_02 = $request['derecho_con'];
        $datos->izquierdo = $request['izquierda'];
        $datos->con_03 = $request['izquierda_con'];
        $datos->fondo = $request['fondo'];
        $datos->con_04 = $request['fondo_con'];
        $datos->tipo_constancia = $request['tip_sol'];
        $datos->save();
        return $datos->id_dat_predio;

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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
