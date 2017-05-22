 <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category"> Nombre</label>
                            <input type="text" class="form-control" id="cNomUsu" placeholder="Nombres" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tags">Apellidos</label>
                            <input type="text" class="form-control" id="cApeUsu" placeholder="Apellidos" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Login</label>
                            <input type="text" class="form-control" id="cLoginUsu" placeholder="Nombre de usuario" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tags">Contraseña</label>
                            <input type="password" class="form-control" id="cPassUsu" placeholder="Contraseña" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category"> Estado</label>
                            <select class="form-control" id="cEstUsu">
                                <option value="0">--Selecione--</option>
                                <option value="20001">Activo</option>
                                <option value="20002">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" id="guardar" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->