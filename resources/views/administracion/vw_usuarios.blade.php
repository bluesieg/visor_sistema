@extends('layouts.app')

@section('content')

<div id="main" role="main">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-user"></i>
            
            <div class="well well-sm well-light">               
               <a href="#" onclick="load_list_Usuarios();" class="btn btn-info">Ver Usuarios</a>
            </div>
            
            <div class="widget-body no-padding">

                <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                    <tr>
                        <th data-hide="phone">ID</th>
                        <th data-class="expand">Nombre</th>
                        <th data-class="expand">email</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Usuarios as $usu)
                    <tr>
                        <td>{{ $usu->id }}</td>
                        <td>{{ $usu->name }}</td>
                        <td>{{ $usu->email }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
           
            
            
            <table id="table_Usuarios"></table>
            <div id="pager_table_Usuarios"></div>
        </h1>
    </div>
</div>
<script src="{{ asset('archivos_js/administracion.js') }}"></script>
@endsection

