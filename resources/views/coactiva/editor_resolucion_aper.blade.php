<!DOCTYPE html>
<html lang="en-us">
    <head>        
        <title> REC </title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production-plugins.min.css">
        <!--<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">-->
        <!--<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">-->
        <style>
        html {
            margin: 0;
            padding-bottom: 0px;
            min-height: 100%;
            background: none;
            z-index: 2;           
        }
        </style>
    </head>
    <body>
        <div style="margin-top:15px" class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
            <h2>EDITAR RESOLUCIÓN DE APERTURA</h2>
        </header>
        <div>
            <div class="widget-body no-padding">
                <textarea id="ckeditor_plantilla_1" name="ckeditor">
                    @php echo $plantilla @endphp
                </textarea>
            </div>
        </div>
    </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
       

        <!--<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>-->
        <script src="js/plugin/ckeditor/ckeditor.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                CKEDITOR.replace('ckeditor', {height: '220px', startupFocus: true,on: {'instanceReady': function (evt) { evt.editor.execCommand('maximize'); }}});
                CKEDITOR.plugins.registered['save'] = {
                    init: function (editor) {
                       var command = editor.addCommand('save',{
                            modes: { wysiwyg: 1, source: 1 },
                            exec: function (editor) { 
                                var contenido = CKEDITOR.instances['ckeditor_plantilla_1'].getData();
                                $.ajax({
//                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    type: 'POST',
                                    url: 'update_plantilla_1',
                                    data:{contenido:contenido},
                                    success: function(){}
                                });
                            }
                       });
                       editor.ui.addButton('Save', { label: 'Save', command: 'save' });
                    }
                }
            });
        </script>
    </body>

</html>