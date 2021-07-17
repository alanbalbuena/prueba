<h1>{{ $modo }} Efectivo</h1>

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
        <input class="form-control" placeholder="Cantidad" type="number" , name="cantidad" , id="cantidad" , value="{{ isset($efectivo->cantidad) ? $efectivo->cantidad : old('cantidad')}}" required>
    </div>
    <div class="form-group col-md-6">
        <input class="form-control" placeholder="Concepto" type="text" , name="concepto" , id="concepto" , value="{{ isset($efectivo->concepto) ? $efectivo->concepto : old('concepto')}}" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <select class="custom-select" id="aplicacion" name="aplicacion" value="{{ isset($efectivo->aplicacion) ? $efectivo->aplicacion : old('aplicacion')}}" required>
            <option value="">Aplicacion</option>
            <option {{ isset($efectivo->aplicacion) ? ($efectivo->aplicacion == 'EMPRESA' ? 'selected' : '') : '' }} value="EMPRESA">EMPRESA</option>
            <option {{ isset($efectivo->aplicacion) ? ($efectivo->aplicacion == 'CHIO' ? 'selected' : '') : ''  }} value="CHIO">CHIO</option>
            <option {{ isset($efectivo->aplicacion) ? ($efectivo->aplicacion == 'EDGAR' ? 'selected' : '') : ''  }} value="EDGAR">EDGAR</option>
            <option {{ isset($efectivo->aplicacion) ? ($efectivo->aplicacion == 'ANGEL' ? 'selected' : '') : ''  }} value="ANGEL">ANGEL</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <input class="form-control" placeholder="Nota" type="text" , name="nota" , id="nota" , value="{{ isset($efectivo->nota) ? $efectivo->nota : old('nota')}}">
    </div>
</div>
<div class="form-group">
    <select class="custom-select" id="tipo" name="tipo" value="{{ isset($efectivo->tipo) ? $efectivo->tipo : old('tipo')}}" required>
        <option value="">Tipo</option>
        <option {{ isset($efectivo->tipo) ? ($efectivo->tipo == 'INGRESO' ? 'selected' : '') : '' }} value="INGRESO">INGRESO</option>
        <option {{ isset($efectivo->tipo) ? ($efectivo->tipo == 'GASTO' ? 'selected' : '') : ''  }} value="GASTO">GASTO</option>
    </select>
</div>
<input class="btn btn-success" type="submit" value="{{ $modo }}">
<a class="btn btn-primary" href="{{ url('efectivo/')}}">Regresar</a>
</div>