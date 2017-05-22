<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;

class General extends Controller
{
    protected $url;
    
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }
    public function index() {
        return view('vw_general');
        
    }
}
