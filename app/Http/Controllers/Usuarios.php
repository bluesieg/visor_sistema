<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Routing\UrlGenerator;

class Usuarios extends Controller
{
//    protected $url;
//    
//    public function __construct(UrlGenerator $url)
//    {
//        $this->url = $url;
//    }
    
    public function getAllUsuarios(){
        $table = DB::select('select * from usuarios limit 10');
//        dd($table);
        return view('administracion/vw_usuarios')->with([
                'Usuarios' => $table]
        );        
    }

    public function index() {
        header('Content-type: application/json');  
        $totalg = DB::select('select count(id) as total from usuarios');
        $page  = $_GET['page']; 
        $limit = $_GET['rows']; 
        $sidx  = $_GET['sidx']; 
        $sord  = $_GET['sord']; 

        $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = $totalg[0]->total;
        if($count > 0){
            $total_pages = ceil($count / $limit);
        }
        if($page > $total_pages){
            $page   = $total_pages;
        }
        $start  = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if($start<0){
            $start = 0;
        }

        $sql = DB::table('usuarios')->orderBy($sidx,$sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
       
        foreach($sql as $Index => $Datos)
        {
            $Lista->rows[$Index]['id'] = $Datos->id;
            $Lista->rows[$Index]['cell']= array(
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
}
