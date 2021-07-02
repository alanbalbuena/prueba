<h1>{{ $modo }} Prestamo </h1>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach

    </ul>
</div>

@endif

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Cantidad</label>
        <input class="form-control" placeholder="Escribe la cantidad aqui" type="text" , name="cantidad" , id="cantidad" , value="{{ isset($prestamo->cantidad) ? $prestamo->cantidad : old('cantidad')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="">Chofer</label>
        <input class="form-control" placeholder="Escribe el chofer aqui" type="text" , name="chofer" , id="chofer" , value="{{ isset($prestamo->chofer) ? $prestamo->chofer : old('chofer')}}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Entrego</label>
        <input class="form-control" placeholder="Escribe quien entrego aqui" type="text" , name="entrego" , id="entrego" , value="{{ isset($prestamo->entrego) ? $prestamo->entrego : old('entrego')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="">Estatus</label>
        <select class="custom-select" id="estatus" name="estatus" value="{{ isset($prestamo->estatus) ? $prestamo->estatus : old('estatus')}}" required>
            <option value="">Estatus</option>
            <option {{ isset($prestamo->estatus) ? ($prestamo->estatus == 'PAGADO' ? 'selected' : '') : '' }} value="PAGADO">PAGADO</option>
            <option {{ isset($prestamo->estatus) ? ($prestamo->estatus == 'PENDIENTE' ? 'selected' : '') : ''  }} value="PENDIENTE">PENDIENTE</option>
        </select>
    </div>
</div>
<!-- <div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Fecha Prestamo</label>
        <input class="form-control"  type="datetime-local" , name="fechaPrestamo" , id="fechaPrestamo" , value="{{ isset($prestamo->fechaPrestamo) ? date($prestamo->fechaPrestamo) : old('fechaPrestamo')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="">Feha Pago</label>
        <input class="form-control" type="datetime-local" , name="fechaPago" , id="fechaPago" , value="{{ isset($prestamo->fechaPago) ? $prestamo->fechaPago : old('fechaPago')}}">
    </div>
</div> -->

<input class="btn btn-success" type="submit" value="{{ $modo }}">
<a class="btn btn-primary" href="{{ url('prestamo/')}}">Regresar</a>
</div>