@extends('layouts.app')

@section('content')

<!-- MAIN CONTENT -->
<div id="content" class="container padding-top-15">
    <div class="padding-top-15"></div>
    <div class="padding-top-15"></div>
    <div class="row padding-top-15">
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
            <h1 class="txt-color-red login-header-big">SmartAdmin</h1>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 padding-top-15">
            <div class="well no-padding">
                <form action="{{ route('login') }}" method="POST" id="login-form" class="smart-form client-form">
                    {{ csrf_field() }}
                    <header>
                        
                        Iniciar Session
                        
                    </header>
                    <fieldset>
                            <section>
                                <label class="label">Usuario</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input id="usuario" type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" required autofocus>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i>Porfavor Ingresa tu Usuario</b></label>
                                    @if ($errors->has('usuario'))
                                        <span class="help-block"><strong>{{ $errors->first('usuario') }}</strong></span>
                                    @endif
                            </section>
                            <section>
                                <label class="label">Password</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>Ingrese el Password</b> </label>
                                    @if ($errors->has('password'))
                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                <div class="note">
                                    <a href="#">Olvidaste tu Password?</a>
                                </div>
                            </section>
                            <section>
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <i></i>Remember Me</label>
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
</div>

@endsection
