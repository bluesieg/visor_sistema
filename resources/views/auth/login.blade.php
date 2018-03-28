@extends('layouts.home')

@section('content')

<!-- MAIN CONTENT -->
<!--<div id="content" class="container padding-top-15">-->
<section id="widget-grid" class="">
    

    <div class="padding-top-15">
        <h1 class="txt-color-green login-header-big"><b>SISTEMA DE INFORMACIÓN URBANA GEOREFERENCIADA INTEGRAL</b></h1>
    </div>
    <div class="row padding-top-15">
        <div class="col-md-8 col-lg-8 hidden-xs">
            <div id="myCarousel" class="carousel fade" style="margin-bottom: 20px;">
                <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                </ol>
                <div class="carousel-inner">
                        <!-- Slide 1 -->
                        <div class="item active">
                                <img src="img/fondos/c_1.png" alt="">
                                <div class="carousel-caption caption-right">
                                    
                                </div>
                        </div>
                        
                        
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
        </div>
                
        </div>
        
        <div class="col-xs-12 col-md-8 col-lg-4">
            <div class="well no-padding">
                <form action="{{ route('login') }}" method="POST" id="login-form" class="smart-form client-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <header>
                        
                        Iniciar Session
                        
                    </header>
                    <fieldset>
                            <section>
                                <label class="label">Usuario</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input id="usuario" type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" required autofocus>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Ingrese su Usuario</b></label>
                                    @if ($errors->has('usuario'))
                                        <span class="help-block"><strong>{{ $errors->first('usuario') }}</strong></span>
                                    @endif
                            </section>
                            <section>
                                <label class="label">Password</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Ingrese el Password</b> </label>
                                    @if ($errors->has('password'))
                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif                                
                            </section>                           
                    </fieldset>
                    <footer>
                        <button type="submit" class="btn btn-primary">
                            Iniciar Sesssion
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
    </section>
<!--</div>-->
@section('page-js-script')
<script type="text/javascript">
    
    $(document).ready(function (){
        $('.carousel.fade').carousel({
                interval : 3000,
                cycle : true
        });
    })
</script>
@stop
@endsection
