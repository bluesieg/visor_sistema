<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Personas;
use App\Models\Usuarios_u;
class Usuarios extends Controller {

    public function vw_usuarios_show() {
        $permisos = DB::connection('pgsql')->select("SELECT * from permisos.vw_permisos where id_sistema='li_config_usuarios' and id_usu=".Auth::user()->id);
        $menu = DB::connection('pgsql')->select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $tip_doc=DB::connection('pgsql')->select('select * from adm_tri.tipo_documento');
        $jef=DB::table('vw_usuarios')->where('jefe',1)->get();
        return view('configuracion/vw_usuarios',compact('tip_doc','jef','menu','permisos'));
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
    
    function guardar_datos_persona(Request $request){
        $data = new Personas();
        $data->pers_ape_pat = $request['pers_ape_pat'];
        $data->pers_ape_mat = $request['pers_ape_mat'];
        $data->pers_nombres = $request['pers_nombres'];
        $data->pers_raz_soc = $request['pers_raz_soc'];
        $data->pers_tip_doc = $request['pers_tip_doc'];
        $data->pers_nro_doc = $request['pers_nro_doc'];
        $data->pers_sexo = $request['pers_sexo'];
        $data->pers_fnac = date('Y-m-d', strtotime($request['pers_fnac']));
        $image=$request['pers_foto'];
        $img_file = file_get_contents($image);
        $data->pers_foto = base64_encode($img_file);
        $data->usuario = Auth::user()->id;
        $data->save();        
        return $data->id_pers;
    }
    
    function traer_datos_dni($nro_doc){        
        $contribuyente = DB::table('public.vw_personas')->where('pers_nro_doc',$nro_doc)->get();
        if(isset($contribuyente[0]->contribuyente)){
            return response()->json([
                    'contrib' => trim(str_replace('-','',$contribuyente[0]->contribuyente)),
                    'id_pers' => trim(str_replace('-','',$contribuyente[0]->id_pers)),
                    'pers_foto'=> $contribuyente[0]->pers_foto,
                    'ape_pat'=> $contribuyente[0]->pers_ape_pat,
                    'ape_mat'=> $contribuyente[0]->pers_ape_mat,
                    'nombres'=> $contribuyente[0]->pers_nombres,
            ]);
        }
    }
    
    function buscar_datos_reniec(Request $request){
        $jefe = DB::table('public.usuarios')->where('id',Auth::user()->id)->get();
        $acceso = DB::connection('pgsql')->table('adm_tri.conexion_reniec')->where('dni',$jefe[0]->dni_jefe)->get();
        
        $rq		= new \stdClass();
        $rq->data	= new \stdClass();
        $rq->auth	= new \stdClass();

        $rq->auth->dni	= $acceso[0]->dni;		// DNI del usuario
        $rq->auth->pas	= $acceso[0]->clave;           // Contrasenia
        $rq->auth->ruc	= $acceso[0]->ruc;	// RUC de la entida del usuario

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

    public function getAllUsuarios2() {
        $table = DB::select('select * from usuarios limit 10');
        
//        dd($table);
        return view('configuracion/vw_usuarios')->with([
                    'Usuarios' => $table]
        );
    }
    function insert_persona_user(Request $request){
        $data = new Personas();
        $data->pers_ape_pat = $request['pers_ape_pat'];
        $data->pers_ape_mat = $request['pers_ape_mat'];
        $data->pers_nombres = $request['pers_nombres'];
        $data->pers_raz_soc = $request['pers_raz_soc'];
        $data->pers_tip_doc = $request['pers_tip_doc'];
        $data->pers_nro_doc = $request['pers_nro_doc'];
        $data->pers_sexo = $request['pers_sexo'];
        $data->pers_fnac = date('Y-m-d', strtotime($request['pers_fnac']));
        $image=$request['pers_foto'];
        $img_file = file_get_contents($image);
        $data->pers_foto = base64_encode($img_file);
        $data->save();        
        return $data->id_pers;
    }

    public function index(Request $request) {
        
        $user = $request['user'];
        $totalg = DB::select("select count(id) as total from vw_usuarios where ape_nom like '%".strtoupper($user)."%'");
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

        $sql = DB::table('public.vw_usuarios')->where('ape_nom','like','%'.strtoupper($user).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        $fch_nac="";
        foreach ($sql as $Index => $Datos) {
            if($Datos->fch_nac){
                $fch_nac=date('d-m-Y', strtotime($Datos->fch_nac));
            }else $fch_nac="";
            $Lista->rows[$Index]['id'] = $Datos->id;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id),
                trim($Datos->dni),
                trim($Datos->ape_nom),
                trim($Datos->usuario),                
                $fch_nac,
                trim($Datos->jefe),
            );
        }

        return response()->json($Lista);
//        echo json_encode($table);  
//        dd($table);
    }

    public function insert_Usuario(Request $request) {
        
        $data = new Usuarios_u();
        $data->dni        = $request['vw_usuario_txt_dni'];
        $data->ape_nom    = strtoupper($request['vw_usuario_txt_ape_nom']);
        $data->usuario    = strtoupper($request['vw_usuario_txt_usuario']);
        $data->password   = bcrypt($request['vw_usuario_txt_password']);
        $data->dni_jefe   = $request['vw_usuario_dni_jefe'];
        $data->id_pers    = $request['vw_usuario_txt_id_pers'];
        $data->contrasena = $this->encripta_pass($request['vw_usuario_txt_password']);
        $data->created_at = date("Y-m-d H:i:s");
        $data->updated_at = date("Y-m-d H:i:s");
        $insert=$data->save();
        if ($insert) {
            $id_pers=$request['vw_usuario_txt_id_pers'];
            DB::select("update public.usuarios set foto=(select pers_foto from public.personas where id_pers=".$id_pers.") where id=".$data->id);
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
                
//        if($request->file('vw_usuario_cargar_foto')){
//            $file = $request->file('vw_usuario_cargar_foto');
//            $file2 = \File::get($file);
//        }
//        if(isset($file2)){
//            $data['foto'] = base64_encode($file2);
//        }else{
//            $data['foto'] = '';
//        }        
        
    }

    function get_datos_usuario(Request $request) {
        $usuario = DB::table('usuarios')->where('id', $request['id'])->get();

        $Lista = new \stdClass();
        foreach ($usuario as $Datos) {
            $Lista->id = trim($Datos->id);
            $Lista->dni = trim($Datos->dni);
            $Lista->ape_nom = trim($Datos->ape_nom);
            $Lista->usuario = trim($Datos->usuario);
            $Lista->jefe = trim($Datos->jefe);
//            $Lista->foto = trim($Datos->foto);
        }
        return response()->json($Lista);
    }

    function validar_user(Request $request) {
//        isset($Consulta[0]->id_pers)
        $usuario = DB::table('usuarios')->select('usuario')->where('usuario', $request['usuario'])->get();
        if (isset($usuario[0]->usuario)) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
    }

    function validar_dni(Request $request) {
        $doc_dni = DB::table('usuarios')->select('dni')->where('dni', $request['dni'])->get();
        if (isset($doc_dni[0]->dni)) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
    }

    function update_Usuario(Request $request) {
//        echo $request['vw_usuarios_id'];
//        $file = $request->file('vw_usuario_cargar_foto');
//        $file2 = \File::get($file);


        $data = $request->all();
//        $data['foto'] = base64_encode($file2);
        $data['created_at'] = date("d-m-Y H:i:s");
        $data['updated_at'] = date("d-m-Y H:i:s");
        
        $update = DB::table('usuarios')->where('id',$request['id'])->update($data);
        if ($update) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
    }

    function eliminar_usuario(Request $data) {
//        if (Auth::user()->id == $data['id']) {
//            $user = User::find($id);
//            $user->delete();
//            Auth::logout();
//            return redirect()->route('welcome');
//        } else {
//            return redirect()->route('home');
//        }

        $user = DB::table('usuarios')->select('usuario')->where('id', '=', $data['id'])->get();
        $delete = DB::table('usuarios')->where('id', $data['id'])->delete();

        if ($delete) {
            return response()->json([
                        'usuario' => $user[0],
            ]);
        }
    }
    
    function cambiar_foto_usuario(Request $request){
        $file = $request->file('vw_usuario_cambiar_cargar_foto');
        $file2 = \File::get($file);        
        
        $id = Auth::user()->id;
        $foto = base64_encode($file2);

        $update = DB::table('usuarios')->where('id',$id)->update(['foto'=>$foto]);
        if ($update) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no','id'=>$id]);
        }
    }
    
    function cambiar_pass_user(Request $request){
              
        
        $id = Auth::user()->id;
        $pass = trim($request['pass1']);

        $update = DB::table('usuarios')->where('id',$id)->update(['password'=> bcrypt($pass)]);
        if ($update) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no','id'=>$id]);
        }
    }
    
    function encripta_pass($c){        
        $tam=strlen($c)-1;
        
        $array = str_split($c);
        
        $ch=$array[0];
        $array[0]=$array[$tam];
        $array[$tam]=$ch;
        $n_p=array();
       
        $j=122;
        for($i=0;$i<=$tam;$i++){            
            $n_p[$i]=chr($j).$array[$i];
            $j--;
        }
        array_push($n_p,chr($j));
        
        $c = implode("", $n_p);
        return $c;
        
    }
    function desencripta_pass($c){
        $tam=strlen($c)-1;
        $array = str_split($c);
        $n_p=array();
        for($i=1;$i<=$tam;$i++){
            if($i%2<>0){
                $n_p[$i]=$array[$i];
            }
        }
        $c = implode("", $n_p);
        $array = str_split($c);
        $tam=count($array)-1;
        $ch=$array[0];
        $array[0]=$array[$tam];
        $array[$tam]=$ch;
        
        $c = implode("", $array);
        return $c;
    }

}
