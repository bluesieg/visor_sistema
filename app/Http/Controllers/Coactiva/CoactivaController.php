<?php

namespace App\Http\Controllers\Coactiva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\DatesTranslator;

class CoactivaController extends Controller
{
    use DatesTranslator;
    public function index(){
        return view('coactiva.vw_coactiva');
    }   
    public function recep_doc() {
        return view('coactiva.vw_recep_doc');
    }
    function emision_apertura_resolucion(){
        return view('coactiva.vw_emision_rec');
    }
    function editor_text(){
        $plantilla=DB::table('coactiva.plantillas')->where('id_plant',1)->value('contenido');
        return view('coactiva.editor_resolucion_aper',compact('plantilla'));
    }
    
    public function show($id)
    {}

    public function edit($id)
    {}

    public function update(Request $request, $id)
    {}

    public function destroy($id)
    {}
    
    function get_doc(Request $request){
                
        $tip_doc=$request['tip_doc'];
        $tip_bus=$request['tip_bus'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        
        if($tip_doc=='1'){
            if($tip_bus=='1'){
                $desde= str_replace('/','-',$request['desde']);
                $hasta=str_replace('/','-',$request['hasta']);
                $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=0 and fch_env between '".$desde."' and '".$hasta."' ");            
            }else if($tip_bus=='2'){
                $del=str_pad($request['del'], 7, "0", STR_PAD_LEFT);
                $al=str_pad($request['al'], 7, "0", STR_PAD_LEFT);
                $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=0 and nro_fis between '".$del."' and '".$al."' ");            
            }
        }else{
            $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=0 and verif_env=0");            
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
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if($tip_doc=='1'){
            if($tip_bus=='1'){
                $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',2)->where('verif_env',0)->whereBetween('fch_env',[$desde,$hasta])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            }else if($tip_bus=='2'){
                $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',2)->where('verif_env',0)->whereBetween('nro_fis',[$del,$al])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            }
        }else{
            $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',0)->where('verif_env',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_gen_fis;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_gen_fis),
                trim($Datos->nro_fis),
                date('d-m-Y', strtotime($Datos->fec_reg)),
                trim($Datos->hora_env),
                trim($Datos->anio),
                trim($Datos->nro_doc),
                str_replace('-','',trim($Datos->contribuyente)),
                trim($Datos->estado),
                trim($Datos->verif_env),
                $Datos->monto,
                "<input type='checkbox' name='chk_recib_doc' value='".$Datos->id_gen_fis."'>"
            );
        }
        return response()->json($Lista); 
    }
    
    function get_doc_recibidos(){
        
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        
        $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=1"); 
        
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
        
        $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',2)->where('verif_env',1)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_gen_fis;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_gen_fis),
                trim($Datos->nro_fis),
                date('d-m-Y', strtotime($Datos->fec_reg)),
                trim($Datos->hora_env),
                trim($Datos->anio),
                trim($Datos->nro_doc),
                str_replace('-','',trim($Datos->contribuyente)),
                trim($Datos->estado),
                trim($Datos->verif_env),
                $Datos->monto,
                "<input type='checkbox' name='chk_doc' value='".$Datos->id_gen_fis."'>"
            );
        }
        return response()->json($Lista); 
    }
    
    function resep_documentos(Request $request){
        $array = explode('-', $request['id_gen_fis']);
        $count=count($array);
        $i=0;
        for($i==0;$i<=$count-1;$i++){            
            DB::table('recaudacion.orden_pago_master')->where('id_gen_fis',$array[$i])
                        ->update(['verif_env'=>1,'fch_recep'=>date('d-m-Y'),'hora_recep'=>date('h:i A')]);
        }
        return response()->json(['msg'=>'si']);
    }
    
    function rec_apertura(){
        $resolucion=DB::select('select * from coactiva.vw_resol_apertura where id_contrib=138');
        $resol=new \stdClass();
        foreach ($resolucion as $Index => $Datos) {
            $resol->id_resol=$Datos->id_resol;
            $resol->id_contrib=$Datos->id_contrib;
            $resol->contribuyente= str_replace('-','',$Datos->contribuyente);
            $resol->nro_resol=$Datos->nro_resol;
            $resol->fch_resol=$Datos->fch_resol;
            $resol->anio_resol=$Datos->anio_resol;
            $resol->monto=$Datos->monto;
            $resol->periodos=$Datos->periodos;
            $resol->nro_rd=$Datos->nro_rd;
            $resol->fch_recep=$Datos->fch_recep;
            $resol->fch_recep_l=mb_strtolower($this->getCreatedAtAttribute($Datos->fch_recep)->format('l, d \d\e F \d\e\l Y'));
        }
        $plantilla=DB::table('coactiva.plantillas')->where('id_plant',1)->value('contenido');

        $plantilla = str_replace('{@fch_recep@}',$resol->fch_recep_l,$plantilla);
        $plantilla = str_replace('{@contribuyente@}',$resol->contribuyente,$plantilla);
        $plantilla = str_replace('{@nro_resol@}',$resol->nro_resol,$plantilla);
        $plantilla = str_replace('{@anio_resol@}',$resol->anio_resol,$plantilla);
        $plantilla = str_replace('{@nro_rd@}',$resol->nro_rd,$plantilla);
        $plantilla = str_replace('{@periodos@}',$resol->periodos,$plantilla);
        $plantilla = str_replace('{@monto@}', number_format($resol->monto,2,'.',','),$plantilla);
//        echo $plantilla;
//        <div style='font-family: SourceSansPro;text-align: justify;font-size:14.8px'>Cerro Colorado,<br />
//<strong><u>VISTOS:</u></strong> El Escrito de fecha {@fch_recep@} de la Gerencia de Administraci&oacute;n Tributaria y Rentas de la Municipalidad Distrital de Cerro Colorado, mediante el cual dicha entidad remite a este Despacho el Expediente del Contribuyente, <strong>Sr. {@contribuyente@}</strong> (en adelante el <strong>obligado</strong>), que contiene la <u>Resoluci&oacute;n de Determinacion N&deg; {@nro_rd@}-{@anio_resol@}-SGFT-MDCC/Arb</u> de fecha {@anio_resol@}, con su respectiva <u>Constancia de Notificaci&oacute;n</u> adjunta a a misma, la <u>Constancia de cosa decidida administrativa</u>, y los actuados que dieron origen a los mismos, respecto de la deuda tributaria sobre Arbitrios Municipales <u>correspondientes a los periodos {@periodos@}; y,</u><br />
//<strong><u>CONSIDERANDO:</u></strong><br />
//<strong><u>Primero.-</u> Premisa Normativa.-</strong> El dispositivo normativo contenido en el Art. 25&deg; de la Ley de Procedimiento de Ejecuci&oacute;n Coactiva Ley N&deg; 26979, su Reglemanto y sus modificatorias establece: <strong>Exigibilidad de la Obligaci&oacute;n.- 25.1.a)</strong> Se Considera Obligaci&oacute;n exigible coactivamente, a la establecida mediante Resoluci&oacute;n de Determinacion o de Multa, emitida por la Entidad conforme a ley, debidamente notificada y no reclamada en el plazo de Ley. <strong>25.4)</strong> Tambi&eacute;n ser&aacute;n exigibles en el mismo procedimiento de las <u>costas y gastos</u> en que la Entidad hubiera incurrido en al cobranza coactiva de la deudas tributarias. De la misma forma se tiene establecido en el Art. 29&deg; de la Ley de Procedimiento de Ejecuci&oacute;n Coactiva, Ley N&deg; 26979, su Reglamento y sus modificatorias, que dispone: <strong>Inicio del Procedimiento.- Art. 29&deg;.-</strong> El Procedimiento es iniciado por el Ejecutor Coactivo mediante notificaci&oacute;n al obligado de la Resoluci&oacute;n de Ejecuci&oacute;n Coactiva, la que contiene un mandato de cumplimiento de la obligaci&oacute;n exigible coactivamente conforme al Art&iacute;culo 25&deg; de la Presente Ley; y dentro del plazo de <u>siete (7) d&iacute;as</u> h&aacute;biles de notificado, bajo apercibimiento de dictarse alguna medida cautelar.<br />
//<strong><u>Segundo.-</u> Premisa F&aacute;ctica.-</strong> La Entidad Administrativa, en este caso, la Gerencia de Administraci&oacute;n Tributaria y rentas de la Municipalidad Distrital de Cerro Colorado (en adelante la <strong>Entidad</strong>), mediente <strong>Resoluci&oacute;n de Determinacion N&deg; {@nro_rd@}-{@anio_resol@}-SGFT-MDCC/Arb</strong> ha determinado la suma de <strong>S/. {@monto@} (CON 00/100 SOLES)</strong> a favor de la Municipalidad Distrital de Cerro Colorado por Concepto de Impuesto Predial, correspondiente a los periodos detallados en la respectiva Resoluci&oacute;n.<br />
//<strong><u>Tercero.-</u></strong> De autos se tiene que, la Entidad ha practicado la notificaci&oacute;n de la <strong>Resoluci&oacute;n de Determinaci&oacute;n N&deg; {@nro_rd@}-{@anio_resol@}-SGFT-MDCC/Arb</strong>, la misma que ha sido <u>debidamente notificada al Obligado</u>, tal como se puede verificar en la <u>constancia de notificaci&oacute;n</u> de fecha {@fch_recep@}, sin que el obligado haya realizado acto de impugnaci&oacute;n alguno en la v&iacute;a administrativa dentro del plazo de ley, por lo que la Gerencia de Administraci&oacute;n Tributaria ha expedido la <u>constancia de cosa decidida administrativa</u> en la cual indica que el acto administrativo no ha sido objeto de impugnaci&oacute;n alguno dentro del plazo de Ley, de tal forma ha quedado <u>consentido</u> y en consecuencia ha adquirido la calidad de Cosa Decidida Administrativamente.
//<div><strong><u>Cuarto.-</u></strong> Por lo tanto, estando a los considerandos y los antecedentes adjuntos, se advierte que <u>la obligaci&oacute;n es exigible coactivamente</u>, la deuda tributaria se ha establecido en acto administrativo emitido por la entidad, esto es, mediante la <strong>Resoluci&oacute;n de Determinaci&oacute;n N&deg; {@nro_rd@}-{@anio_resol@}-SGFT-MDCC/Arb</strong>, en la cual <strong>se ha identificado plenamente al Obligado (deudor tributario), as&iacute; como la cuant&iacute;a del Tributo y los Intereses, el monto total de la deuda y el periodo a que corresponde</strong>, la misma que ha sido <u>debidamente notificada al Obligado en su oportunidad</u>.<br />
//<strong><u>Quinto.-</u></strong> En consecuencia, existiendo obligaci&oacute;n exigible coactivamente contenido en una Resoluci&oacute;n de Determinaci&oacute;n debidamente notificada, la misma que ha sido ejecutoriada y/o consentida, y solicitado a este Despacho por la Entidad en contra del Obligado para su cumplimiento, es viable dar inicio al Procedimiento de Ejecuci&oacute;n Coactiva en contra del Obligado, otorgandole el plazo de siete d&iacute;as h&aacute;biles de notificada la presente, a efectos de que cumpla con pagar la deuda tributaria sobre Impuesto Predial a favor de la Entidad; y estando a lo establecido en el Art. 9&deg; y 192&deg; de la Ley de Procedimiento Administrativo General Ley N&deg; 27444, y a lo establecido en el dispositivo normativo contenido en el Art. 25&deg; y 29&deg; de la Ley de Procedimiento de Ejecuci&oacute;n Coactiva Ley N&deg; 26979, su reglamento y sus modificatorias, y dentro de las facultades concedidas por la Ley citada;<br />
//<strong><u>SE RESUELVE:</u></strong><br />
//<strong><u>PRIMERO.-</u> ADMITIR A TR&Aacute;MITE </strong>la solicitud presentada por la Entidad, en tal sentido, <strong>SE DISPONE EL INICIO</strong> del Procedimiento de Ejecuci&oacute;n Coactiva en contra del Obligado, <strong>Sr. {@contribuyente@}</strong>, a qui&eacute;n se debe notificar con copia del acto administrativo generador de la Obligaci&oacute;n Tributaria, su correspondiente Constancia de notificaci&oacute;n, as&iacute; como la Constancia de cosa decidida administrativa.<br />
//<strong><u>SEGUNDO.-</u> SE DISPONE REQUERIR</strong> al Obligado, <strong>Sr. {@contribuyente@}</strong>, para que en el <strong>PLAZO DE SIETE (07) D&Iacute;AS H&Aacute;BILES</strong> de notificado, <strong>CUMPLA CON PAGAR A FAVOR DE LA MUNICIPALIDAD DISTRITAL DE CERRO COLORADO, LA SUMA DE S/. {@monto@} (CON 00/100 SOLES)</strong> por concepto de <u>Arbitrios Municipales correspondiente a los a&ntilde;os {@periodos@}</u>, del predio ubicado en la Libertad Mariano Melgar 101, Distrito de Cerro Colorado, conforme se expresa en la Resoluci&oacute;n de Determinaci&oacute;n N&deg; {@nro_rd@}-{@anio_resol@}-SGFT-MDCC/Arb, m&aacute;s el pago de los <u>intereses actualizados</u> a la fecha de cancelaci&oacute;n de la obligaci&oacute;n, as&iacute; como las <u>costas y gastos</u> ocasionados a la entidad, BAJO APERCIBIMIENTO DE DICTARSE <u>MEDIDA CAUTELAR Y/O EMBARGOS</u> ESTABLECIDAS EN LA LEY DE PROCEDIMIENTO DE EJECUCI&Oacute;N COACTIVA, SU REGLAMENTO Y SUS MODIFICATORIAS.<br />
//<strong><u>Se Adjunta:</u></strong> Copia de la Resoluci&oacute;n de Determincaci&oacute;n N&deg; {@nro_rd@}-{@anio_resol@}-SGFT-MDCC/Arb, la Constancia de notificaci&oacute;n, y la Constancia de cosa decidida administrativa.<br />
//<strong>T&oacute;mese Raz&oacute;n y H&aacute;gase Saber.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.</strong></div>
//</div>
        
        $view = \View::make('coactiva.reportes.rec_apertura',compact('plantilla','resol'))->render();
        $pdf = \App::make('dompdf.wrapper');            
        $pdf->loadHTML($view)->setPaper('a4');
        return $pdf->stream();
    }
    
    function update_plantilla_1(Request $request){
        $contenido = $request['contenido'];
        dd($contenido);
        $update = DB::table('coactiva.plantillas')->where('id_plant',1)
                        ->update(['contenido'=>$contenido]);
    }
}
