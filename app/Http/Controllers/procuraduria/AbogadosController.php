<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbogadosController extends Controller
{
    public function index()
    {
        return view('procuraduria/vw_abogados');
    }
    public function create()
    {
        //
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
