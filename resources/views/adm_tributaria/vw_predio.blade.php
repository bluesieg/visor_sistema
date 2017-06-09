@extends('layouts.app')
@section('content')
<section>
<div class=''>
    <select class="input-sm form-control">
    @foreach ($sectores as $sectores)
    <option value='{{$sectores->id_sec}}'>{{$sectores->sector}}</option>
    @endforeach
    </select>
    
    <select class="input-sm form-control">
    @foreach ($manzanas as $manzanas)
    <option value='{{$manzanas->id_mzna}}'>{{$manzanas->codi_mzna}}</option>
    @endforeach
    </select>
</div>
</section>


@endsection




