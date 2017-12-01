<?php

namespace App\Http\Controllers\archivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatesTranslator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Models\archivo\digitalizacion;
use App\Models\archivo\auditoria_digitalizacion;

class DigitalizacionController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_arch_reg_exp' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $tip_doc = DB::connection('digitalizacion')->select("select * from tip_doc");
        return view('archivo/vw_digitalizacion', compact('menu','permisos','tip_doc'));
    }

    public function create(Request $request)
    {
        //declar_inscripcion;
        $file = $request->file('dlg_documento_file');
        
        if($file)
        {
            $file2 = \File::get($file);
            $dig=new digitalizacion;
            $dig->id_contribuyente=$request['id_contrib_hidden'];
            $dig->id_tip_doc=$request['seltipdoc'];
            $dig->anio=$request['dlg_anio'];
            $dig->fecha=$request['dlg_fec'];
            $dig->observacion=strtoupper($request['dlg_obs_exp']);
            $dig->direccion=strtoupper($request['dlg_direcc_hiddn']);
            $dig->id_usuario = Auth::user()->id;
            $dig->fec_reg = date("d/m/Y");
            $dig->save();
            $tipo_schema = DB::connection('digitalizacion')->select("select * from tip_doc where id_tip=".$request['seltipdoc']);
            if(count($tipo_schema)>=1)
            {
                DB::connection('digitalizacion')->table(trim($tipo_schema[0]->schem).".".trim($tipo_schema[0]->abrev).$dig->anio)->insert([
                    ['doc_b64' => base64_encode($file2), 'id' => $dig->id,'id_usuario'=>Auth::user()->id]
                ]);
            }
            return $dig->id;
        }
        else
        {
            return 0;
        }
    }

    public function store(Request $request)
    {
    }

 
    public function show($id)
    {
        $archi= DB::connection('digitalizacion')->table('vw_digital')->where('id',$id)->get();
        $archi[0]->fecha=trim($this->getCreatedAtAttribute($archi[0]->fecha)->format('d/m/Y'));
        return $archi;
    }

    public function edit(Request $request)
    {
        
        $dig=new digitalizacion;
        $val=  $dig::where("id","=",$request['id_arch'] )->first();
        if(count($val)>=1)
        {
            $this->crea_auditoria($val,$request);
            $tipo_schema = DB::connection('digitalizacion')->select("select * from tip_doc where id_tip=".$request['seltipdoc']);
            $file = $request->file('dlg_documento_file');
            if($val->id_tip_doc!=$request['seltipdoc']||$val->anio!=$request['dlg_anio'])
            {
                $sql = DB::connection('digitalizacion')->select('select * from vw_digital where id='.$val->id);
                if($file)
                {
                    $file2 = \File::get($file);
                    DB::connection('digitalizacion')->table(trim($tipo_schema[0]->schem).".".trim($tipo_schema[0]->abrev).$request['dlg_anio'])->insert([
                        ['doc_b64' => base64_encode($file2), 'id' => $val->id,'id_usuario'=>Auth::user()->id]
                    ]);
                }
                else
                {
                    $pdf = DB::connection('digitalizacion')->table(trim($sql[0]->schem).".".trim($sql[0]->abrev).$sql[0]->anio)->where('id',$val->id)->get();
                    DB::connection('digitalizacion')->table(trim($tipo_schema[0]->schem).".".trim($tipo_schema[0]->abrev).$request['dlg_anio'])->insert([
                        ['doc_b64' => $pdf[0]->doc_b64, 'id' => $val->id,'id_usuario'=>Auth::user()->id]
                    ]);
                }
                DB::connection('digitalizacion')->table(trim($sql[0]->schem).".".trim($sql[0]->abrev).$sql[0]->anio)->where('id',$val->id)->delete();
                $val->id_tip_doc=$request['seltipdoc'];
                $val->anio=$request['dlg_anio'];
            }
            else
            {
                if($file)
                {
                    $file2 = \File::get($file);
                    DB::connection('digitalizacion')->table(trim($tipo_schema[0]->schem).".".trim($tipo_schema[0]->abrev).$request['dlg_anio'])
                    ->where('id', $val->id)
                    ->update(['doc_b64' => base64_encode($file2)]);
                }
            }
            $val->id_tip_doc=$request['seltipdoc'];
            $val->fecha=$request['dlg_fec'];
            $val->observacion=strtoupper($request['dlg_obs_exp']);
            $val->direccion=strtoupper($request['dlg_direcc_hiddn']);
            $val->save();
        }
        return $val->id;
    }
    
    public function crea_auditoria($val,Request $request)
    {
        $file = $request->file('dlg_documento_file');
        $obs="";
        if($file)
        {
            $obs="Cambio Archivo pdf";
        }
        $aud=new auditoria_digitalizacion;
        $aud->id_contribuyente=$val->id_contribuyente;
        $aud->id_tip_doc=$val->id_tip_doc;
        $aud->anio=$val->anio;
        $aud->fecha=$val->fecha;
        $aud->observacion=$val->observacion;
        $aud->id=$val->id;
        $aud->direccion=$val->direccion;
        $aud->id_usuario_mod = Auth::user()->id;
        $aud->fec_mod = date("d/m/Y");
        $aud->sql_mod = $obs." update digitalizacion set id_tip_doc=".$request['seltipdoc'].", fecha=".$request['dlg_fec'].", observacion=".$request['dlg_obs_exp'].", direccion=".strtoupper($request['dlg_direcc_hiddn']);
        $aud->save();
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {   
        $dig=new digitalizacion;
        $val=  $dig::where("id","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $tipo_schema = DB::connection('digitalizacion')->select("select * from tip_doc where id_tip=".$val->id_tip_doc);
            DB::connection('digitalizacion')->table(trim($tipo_schema[0]->schem).".".trim($tipo_schema[0]->abrev).$val->anio)->where('id',$val->id)->delete();
            $val->delete();
        }
        return "destroy ".$request['id'];
    }
    
     function grid_expe(Request $request){
         if($request['contrib']==0)
         {
             return 0;
         }
         else
         {
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }
            
            $totalg = DB::connection('digitalizacion')->select("select count(id) as total from vw_digital where id_contribuyente=".$request['contrib']);
            $sql = DB::connection('digitalizacion')->table('vw_digital')->where('id_contribuyente',$request['contrib'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            

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
                if($Datos->fecha=="")
                {
                    $Datos->fecha="SIN FECHA";
                }
                else
                {
                    $Datos->fecha=$this->getCreatedAtAttribute($Datos->fecha)->format('d/m/Y');
                }
                $Lista->rows[$Index]['id'] = $Datos->id;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id),
                    trim($Datos->anio),
                    trim($Datos->documento),
                    trim($Datos->fecha),
                    trim($Datos->observacion),
                    '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile('.trim($Datos->id).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver</button>',
                );
            }
            return response()->json($Lista);
        }
     }
     
    function get_pdf()
    {   
           $file = file_get_contents($_FILES['dlg_documento_file']['tmp_name']);
            if($_FILES["dlg_documento_file"]["type"]=='application/pdf')
            {  
                return Response::make($file, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="prueba"'
                ]);
            }
            else
            {    return "<html><head></head><body style='margin:3px;padding:0px;font-family:verdana;font-size:11px'>No es .pdf</body></html>";$i=0;}
    }
    public function verfile($id)
    {
        $sql = DB::connection('digitalizacion')->select('select * from vw_digital where id='.$id);
        if(count($sql)>=1)
        {
            $pdf = DB::connection('digitalizacion')->table(trim($sql[0]->schem).".".trim($sql[0]->abrev).$sql[0]->anio)->where('id',$id)->get();
            return Response::make(base64_decode($pdf[0]->doc_b64), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="prueba"'
                ]);
        }
        else
        {
            return "No hay Archvos";
        }
    }
    public function get_cotrib_byname(Request $request) {
        if($request['dat']=='0')
        {
            return 0;
        }
        else
        {
        header('Content-type: application/json');
        $totalg = DB::connection('digitalizacion')->select("select count(id_contrib) as total from vw_contribuyentes where nombres like '%".strtoupper($request['dat'])."%'");
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

        $sql = DB::connection('digitalizacion')->table('vw_contribuyentes')->where('nombres','like', '%'.strtoupper($request['dat']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_contrib;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_contrib),
                trim($Datos->nro_documento),
                trim(str_replace("-", "",$Datos->nombres)),
                trim($Datos->domicilio),
                trim($Datos->nro_expediente),
            );
        }
        return response()->json($Lista);
        }
    }
    public function validar(Request $request)
    {
        $direcs = explode("; ", $request['dir']);
        $lista="";
        foreach($direcs as $dirs)
        {
            $count = DB::connection('digitalizacion')->select("select * from vw_digital where direccion like '%".strtoupper($dirs)."%' and id_contribuyente <> ".$request['contri']);
            if(count($count)>0)
            {   
                $lista=$lista."La Direccion -".$dirs."- ya fue registrada en los siguientes Contribuyentes:<br>";
                $poseedores = DB::connection('digitalizacion')->select("select nombres from vw_digital where direccion like '%".strtoupper($dirs)."%' and id_contribuyente <> ".$request['contri']." group by nombres");
                foreach($poseedores as $contri)
                {
                    $lista=$lista."---".$contri->nombres."<br>";
                }
            }
        }
        return $lista;
    }
    /////////// reportes///////////
    public function index_reportes_arch()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_rep_arch' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('archivo/vw_reportes_archivo', compact('menu','permisos','anio_tra'));
    }
    public function ver_reporte_arc($contrib,$tip)
    {
        if($tip=='1')
        {
            return $this->rep_por_contri($contrib);
        }
        if($tip=='2')
        {
            return $this->rep_fallecidos();
        }
        if($tip=='3')
        {
            return $this->rep_sin_documentos();
        }
        if($tip=='4')
        {
            return $this->rep_por_direccion($contrib);
        }
        if($tip=='5')
        {
            return $this->rep_inafectos();
        }
        if($tip=='6')
        {
            return $this->rep_compraventa();
        }
         if($tip=='7')
        {
            return $this->rep_donaciones();
        }
         if($tip=='8')
        {
            return $this->rep_transferencias();
        }
         if($tip=='9')
        {
            return $this->rep_sucesionintestada();
        }
         if($tip=='10')
        {
            return $this->rep_sucesiontestamentaria();
        }
         if($tip=='10')
        {
            return $this->rep_anticipodelegitima();
        }
         if($tip=='11')
        {
            return $this->rep_anticipodelegitima();
        }
          if($tip=='12')
        {
            return $this->rep_subdivision();
        }
          if($tip=='13')
        {
            return $this->rep_independizacion();
        }
          if($tip=='14')
        {
            return $this->rep_declaraciondedescargo();
        }
          if($tip=='15')
        {
            return $this->rep_recunificacion();
        }
          if($tip=='16')
        {
            return $this->rep_recsubdivision();
        }
          if($tip=='17')
        {
            return $this->rep_recaumentovalor();
        }
    }
    public function rep_por_contri($contrib)
    {
        $sql = DB::connection('digitalizacion')->table('vw_digital')->where('id_contribuyente',$contrib)->orderBy('anio', 'desc')->get();
            if(count($sql)>=1)
            {
                for($i=0;$i<count($sql);$i++) 
                {
                    if($sql[$i]->fecha=="")
                    {
                        $sql[$i]->fecha="SIN FECHA";
                    }
                    else
                    {
                        $sql[$i]->fecha=$this->getCreatedAtAttribute($sql[$i]->fecha)->format('d/m/Y');
                    }
                }
                $view =  \View::make('archivo.reportes.rep_por_contribuyente', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4');
                return $pdf->stream("por_contribuyente.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
    public function rep_fallecidos()
    {
        $sql = DB::connection('digitalizacion')->select("select t1.* from (select id_contribuyente,nro_documento,nombres,domicilio,nro_expediente,documento, id, anio,observacion from vw_digital tbl
            where EXISTS(select id_contribuyente,Max(anio) As anio from vw_digital Group by id_contribuyente HAVING id_contribuyente = tbl.id_contribuyente And Max(anio) = tbl.anio)
            order by id_contribuyente) t1
            where t1.observacion like '%DEFUNCION%'");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_fallecidos', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4');
                return $pdf->stream("fallecidos.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
    public function rep_sin_documentos()
    {
        $sql = DB::connection('digitalizacion')->select("select t1.* from (select id_contribuyente,nro_documento,nombres,domicilio,nro_expediente,documento, id, anio,observacion from vw_digital tbl
        where EXISTS(select id_contribuyente,Max(anio) As anio from vw_digital Group by id_contribuyente HAVING id_contribuyente = tbl.id_contribuyente And Max(anio) = tbl.anio)
        order by id_contribuyente) t1
        where t1.anio < 2010 ORDER BY nombres");
        if(count($sql)>=1)
        {
            $view =  \View::make('archivo.reportes.rep_sin_documentos', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("sin_documentos.pdf");
        }
        else
        {
            return "No Hay Datos";
        }
    }
    public function rep_por_direccion($dir)
    {
        $consulta="";$iniciador=0;
        $direcs = explode(" ", strtoupper($dir));
        foreach($direcs as $dirs)
        {
            if($iniciador==1)
            {
                $consulta.=" AND ";
            }
            if($dirs!="")
            {
                $consulta.="t1.direccion like '%$dirs%'";
            }
            if($iniciador==0)
            {
                $iniciador=1;
            }
        }
        $sql = DB::connection('digitalizacion')->select("select t1.* from (select id_contribuyente,nro_documento,nombres,domicilio,nro_expediente,documento, id, anio,direccion from vw_digital tbl
        where EXISTS(select id_contribuyente,Max(anio) As anio from vw_digital Group by id_contribuyente HAVING id_contribuyente = tbl.id_contribuyente And Max(anio) = tbl.anio)
        order by id_contribuyente) t1
        where $consulta ORDER BY anio desc");
        if(count($sql)>=1)
        {
            $view =  \View::make('archivo.reportes.rep_por_direccion', compact('sql','dir'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("por_direccion.pdf");
        }
        else
        {
            return "No Hay Datos";
        }
    }
    public function rep_inafectos()
    {
        $sql = DB::connection('digitalizacion')->select("select t1.* from (select id_contribuyente,nro_documento,nombres,domicilio,nro_expediente,documento, id, anio,observacion,direccion from vw_digital tbl
            where EXISTS(select id_contribuyente,Max(anio) As anio from vw_digital Group by id_contribuyente HAVING id_contribuyente = tbl.id_contribuyente And Max(anio) = tbl.anio)
            order by id_contribuyente) t1
            where t1.observacion like '%INAFECT%'");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_inafectos', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("inafectos.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
    public function rep_compraventa()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
             FROM vw_digital
             WHERE observacion like '%VENTA%' and observacion like '%COMPRA%' and id_tip_doc=1
             ORDER BY nombres asc,anio desc
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_compraventa', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("compraventa.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_donaciones()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
                FROM vw_digital
                WHERE observacion like '%DONACI%' and id_tip_doc=1
                ORDER BY nombres asc,anio desc
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_donaciones', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("donaciones.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_transferencias()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
                FROM vw_digital
                WHERE observacion like '%TRANSFEREN%' and id_tip_doc=1
                ORDER BY nombres asc,anio desc
                
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_transferencias', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("transferencias.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_sucesionintestada()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
                FROM vw_digital
                WHERE observacion like '%INTESTADA%' and id_tip_doc=1
                ORDER BY nombres asc,anio desc
                
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_sucesionintestada', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("sucesionintestada.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_sucesiontestamentaria()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
                FROM vw_digital
                WHERE observacion like '%TESTAMENTA%' and id_tip_doc=1
               ORDER BY nombres asc,anio desc
                
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_sucesiontestamentaria', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("sucesiontestamentaria.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_anticipodelegitima()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
                FROM vw_digital
                WHERE observacion like '%ANTICIPO%'  and id_tip_doc=1
                ORDER BY nombres asc,anio desc
                
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_anticipodelegitima', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("anticipodelegitima.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_subdivision()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
                FROM vw_digital
                WHERE observacion like '%SUB%' and observacion like '%DIVI%'  and id_tip_doc=1
                ORDER BY nombres asc,anio desc
                
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_subdivision', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("subdivision.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_independizacion()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
                FROM vw_digital
                WHERE observacion like '%INDEPENDIZA%'  and id_tip_doc=1
                ORDER BY nombres asc,anio desc
                
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_independizacion', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("independizacion.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_declaraciondedescargo()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
                FROM vw_digital
                WHERE  id_tip_doc=7 ORDER BY nombres asc,anio desc
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_declaraciondedescargo', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("declaraciondedescargo.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
     public function rep_recunificacion()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
             FROM vw_digital
             WHERE id_tip_doc = 3 and observacion like '%UNIFICA%' 
             ORDER BY anio desc, nombres asc
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_recunificacion', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("recunificacion.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
      public function rep_recsubdivision()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
             FROM vw_digital
             WHERE id_tip_doc = 3 and observacion like '%SUB%' and observacion like '%DIV%' 
             ORDER BY anio desc, nombres asc
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_recsubdivision', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("recsubdivision.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
      public function rep_recaumentovalor()
    {
        $sql = DB::connection('digitalizacion')->select("SELECT *
             FROM vw_digital
             WHERE id_tip_doc = 4 
             ORDER BY anio desc, nombres asc
            ");
            if(count($sql)>=1)
            {
                $view =  \View::make('archivo.reportes.rep_recaumentovalor', compact('sql'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4','landscape');
                return $pdf->stream("recaumentovalor.pdf");
            }
            else
            {
                return "No Hay Datos";
            }
    }
}
