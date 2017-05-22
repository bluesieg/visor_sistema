@extends('layouts.app')

@section('content')
<div id="main" role="main">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <!-- PAGE HEADER -->
            <i class="fa-fw fa fa-home"></i> 
                Page Header 
            <span>>  
                Subtitle
            </span>
               
            <div class="btn-group">
                <a style="cursor:pointer" class="recargar_nuevo btn btn-sm btn-primary"
                   href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp;Nuevo
                    Comensal</a>
            </div>
            <div class="well well-sm well-light">
                <h3>Dialogue</h3>
                <a href="#" id="dialog_link" class="btn btn-info"> Open Dialog </a>

            </div>

             @include('fnewUsuario')
        </h1>
    </div>
</div>

<div class="modal fade" id="myModal" data-backdrop='static' role="dialog">
     HOLA
</div>


@endsection
