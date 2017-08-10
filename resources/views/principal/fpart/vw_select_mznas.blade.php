<label class="label" style="text-align: center">MANZANAS:</label>
<select id="select_cod_mzna" class="input-sm col-xs-12">
    <option value='0' >-- Seleccion una Manzana --</option>
    @foreach ($mznas as $m)
        <option value='{{$m->gid}}' >{{$m->mz_cat}}</option>
    @endforeach
</select><i></i>