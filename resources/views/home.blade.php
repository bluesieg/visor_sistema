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
                
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="well well-sm well-light">
                        <h3>Dialogue</h3>
                        <a href="#" id="dialog_link" class="btn btn-info">Dialog</a>
                        &nbsp;
                        <a href="#" id="modal_link" class="btn bg-color-purple txt-color-white"> Open Modal Dialog</a>
                    </div>
                </div>
            </div>

        </h1>
    </div>
</div>

<div id="dialog_simple" title="Dialog Simple Title">
    <p>
        Dialog Dialog
    </p>
</div>

<div id="dialog-message" title="Dialog Simple Title">
    <p>
        Mensaje de Este dialogo
    </p>

    <div class="hr hr-12 hr-double"></div>
        Currently using
        <b>36% of your storage space</b>
        <div class="progress progress-striped active no-margin">
            <div class="progress-bar progress-primary" role="progressbar" style="width: 36%"></div>
        </div>
</div>

@endsection
