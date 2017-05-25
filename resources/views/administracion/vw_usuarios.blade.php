@extends('layouts.app')



@section('content')

<div id="main" role="main">
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="table_Usuarios"></table>
                    <div id="pager_table_Usuarios"></div>
                </article>
            </div>
        </section>       
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function() {
        jQuery("#table_Usuarios").jqGrid({ 
            url: 'list_usuarios',
            datatype: 'json', mtype: 'GET',        
            height: 'auto', autowidth : true,
            toolbarfilter : true,
            colNames:['id','DNI',' Nombres','Usuario','Nivel','Fecha Nac.'], 
            rowNum: 10, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE USUARIOS REGISTRADOS',  align: "center",
            colModel:[ 
                {name:'id',index:'id', hidden:true}, 
                {name:'dni',index:'dni', align:'left'}, 
                {name:'ape_nom',index:'ape_nom', align:'left'},
                {name:'usuario',index:'usuario'},
                {name:'nivel',index:'nivel'},
                {name:'fch_nac',index:'fch_nac'}
            ],        
            pager: '#pager_table_Usuarios',
            rowList: [10, 20],
            onSelectRow: function(Id){

            }
        });
        $(window).on('resize.jqGrid', function() {
                $("#table_Usuarios").jqGrid('setGridWidth', $("#content").width());
        });
    });
</script>
@stop

<script src="{{ asset('archivos_js/administracion.js') }}"></script>


@endsection

<!--asd

<thead>
                                            <tr>
                                                <th data-hide="phone">ID</th>
                                                <th data-class="expand">DNI</th>
                                                <th data-class="expand">Nombres</th>
                                                <th data-class="expand">Usuarios</th>
                                                <th data-class="expand">Fech. Naci.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Usuarios as $usu)
                                            <tr>
                                                <td>{{ $usu->id }}</td>
                                                <td>{{ $usu->dni }}</td>
                                                <td>{{ $usu->ape_nom }}</td>
                                                <td>{{ $usu->usuario }}</td>
                                                <td>{{ $usu->fch_nac }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
-->

