@extends('layouts.app')

@section('content')
<div id="main" role="main">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <!-- PAGE HEADER -->
            <i class="fa-fw fa fa-home"></i> 
                Principal 
            <span>>  
                Container
            </span>
                
            <div class="well well-sm well-light">
                <h3>Dialogue</h3>
                <a id="dialog_link" class="btn btn-info" href="#"> Open Dialog </a>
                <a id="modal_link" class="btn bg-color-purple txt-color-white" href="#"> Open Modal Dialog </a>
            </div>

        </h1>
    </div>
</div>
<script src="{{ asset('archivos_js/administracion.js') }}"></script>
@include('administracion/vw_general')

@endsection
