<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Personas;
class Usuarios extends Controller {

    public function vw_usuarios_show() {
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        $tip_doc=DB::select('select * from adm_tri.tipo_documento');
        $jef=DB::table('vw_usuarios')->where('jefe',1)->get();
        return view('configuracion/vw_usuarios',compact('tip_doc','jef','menu'));
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
        $data->pers_fnac = $request['pers_fnac'];
        $image=$request['pers_foto'];
        $img_file = file_get_contents($image);
        $data->pers_foto = base64_encode($img_file);
        $data->save();        
        return $data->id_pers;
    }

    public function index() {
        header('Content-type: application/json');
        $totalg = DB::select('select count(id) as total from usuarios');
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

        $sql = DB::table('usuarios')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id),
                trim($Datos->dni),
                trim($Datos->ape_nom),
                trim($Datos->usuario),                
                '12/12/2012'
            );
        }

        return response()->json($Lista);
//        echo json_encode($table);  
//        dd($table);
    }

    public function insert_Usuario(Request $request) {
        
//        if($request->file('vw_usuario_cargar_foto')){
//            $file = $request->file('vw_usuario_cargar_foto');
//            $file2 = \File::get($file);
//        }

        $data = array();
        $data['dni'] = $request['vw_usuario_txt_dni'];
        $data['ape_nom'] = strtoupper($request['vw_usuario_txt_ape_nom']);
        $data['usuario'] = strtoupper($request['vw_usuario_txt_usuario']);
        $data['password'] = bcrypt($request['vw_usuario_txt_password']);
        $data['dni_jefe'] = bcrypt($request['vw_usuario_dni_jefe']);
        $data['cad_lar'] = strtoupper($request['vw_usuario_txt_ape_nom']) . ' ' . $request['vw_usuario_txt_dni'] . ' ' . strtoupper($request['vw_usuario_txt_usuario']);
        $data['contrasena']= $this->encripta_pass($request['vw_usuario_txt_password']);
//        if(isset($file2)){
//            $data['foto'] = base64_encode($file2);
//        }else{
//            $data['foto'] = '';
//        }        

        $data['created_at'] = date("Y-m-d H:i:s");$data['updated_at'] = date("Y-m-d H:i:s");

        $insert = DB::table('usuarios')->insert($data);

        if ($insert) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
    }

    function get_datos_usuario(Request $request) {
        $usuario = DB::table('usuarios')->where('id', $request['id'])->get();

        $Lista = new \stdClass();
        foreach ($usuario as $Datos) {
            $Lista->id = trim($Datos->id);
            $Lista->dni = trim($Datos->dni);
            $Lista->ape_nom = trim($Datos->ape_nom);
            $Lista->usuario = trim($Datos->usuario);            
//            $Lista->foto = trim($Datos->foto);
        }
        return response()->json($Lista);
    }

    public function validar_user(Request $request) {
//        isset($Consulta[0]->id_pers)
        $usuario = DB::table('usuarios')->select('usuario')->where('usuario', $request['usuario'])->get();
        if (isset($usuario[0]->usuario)) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
    }

    public function validar_dni(Request $request) {
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

        $data['cad_lar'] = strtoupper($request['ape_nom']) . ' ' . $request['dni'] . ' ' . strtoupper($request['usuario']);


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
    
    public function encripta_pass($c){        
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
    public function desencripta_pass($c){
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
