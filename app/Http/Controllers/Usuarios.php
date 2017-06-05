<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Usuarios extends Controller {

    public function getAllUsuarios() {
        $table = DB::select('select * from usuarios limit 10');
//        dd($table);
        return view('configuracion/vw_usuarios')->with([
                    'Usuarios' => $table]
        );
    }

    public function getAllUsuarios2() {
        $table = DB::select('select * from usuarios limit 10');
        dd($table);
//        dd($table);
        return view('configuracion/vw_usuarios')->with([
                    'Usuarios' => $table]
        );
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
                trim($Datos->nivel),
                trim($Datos->fch_nac)
            );
        }

        return response()->json($Lista);
//        echo json_encode($table);  
//        dd($table);
    }

    public function insert_update_Usuarios(Request $request) {
        header('Content-type: application/json');
        $data = $request->all();


        if ($this->validar_user($data['usuario'])) {//valida si el usuario ya existe
            return response()->json([
                        'msg' => 'Usuario',
                        'valor' => $data['usuario'] . ' Existe...'
            ]);
        } else {
            return response()->json([
                        'msg' => 'Usuario',
                        'valor' => $data['usuario'] . ' No Existe...'
            ]);
        }
//        if ($this->validar_dni($data['dni'])) {//valida si el dni ya existe
//            return response()->json([
//                        'msg' => 'DNI',
//                        'valor' => $data['dni']
//            ]);
//        }
//        if (isset($data['id']) && $this->update_usuario($request->all())) {//update
//            return response()->json([
//                        'msg' => 'Usuario',
//                        'valor' => strtoUpper($data['usuario'])
//            ]);
//        }
//        if ($this->insert_usuario($request->all())) {
//            return response()->json([
//                        'msg' => 'Usuario',
//                        'valor' => strtoUpper($data['usuario'])
//            ]);
//        }
    }

    public function validar_user($user) {
        $usuario = DB::table('usuarios')->select('usuario', 'id')->where('usuario', $user)->get();
        if ($usuario->usuario != '')
            return true;
        else
            return false;
    }

    public function validar_dni($dni) {
        $doc_dni = DB::table('usuarios')->select('dni', 'id')->where('dni', '=', $dni)->get();
        if ($doc_dni)
            return false;
        else
            return true;
    }

    public function insert_usuario(array $data) {
        $user = array(
            'ape_nom' => strtoUpper(trim($data['ape_nom'])),
            'usuario' => strtoUpper(trim($data['usuario'])),
            'fono' => strtoUpper(trim($data['fono'])),
            'cad_lar' => strtoUpper(trim($data['ape_nom'])) . " " . strtoUpper(trim($data['usuario'])),
            'rol' => 'USUARIO',
            'created_at' => date("d-m-Y H:i:s"),
            'updated_at' => date("d-m-Y H:i:s"),
        );
        $insert = DB::table('usuarios')->insert($user);
        if ($insert)
            return true;
        else
            return false;
    }

    public function update_usuario(array $data, $id) {
        $user = array(
            'ape_nom' => strtoUpper(trim($data['ape_nom'])),
            'usuario' => strtoUpper(trim($data['usuario'])),
            'fono' => strtoUpper(trim($data['fono'])),
            'cas_id' => $data['casa'],
            'password' => bcrypt(trim($data['contra'])),
            'estado' => $data['estado'],
            'cad_lar' => strtoUpper(trim($data['ape_nom'])) . " " . strtoUpper(trim($data['usuario'])),
            'rol' => 'USUARIO',
            'updated_at' => date("Y-m-d H:i:s")
        );
        $insert = DB::table('usuarios')->where('id', $id)->update($user);
        if ($insert)
            return true;
        else
            return false;
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

}
