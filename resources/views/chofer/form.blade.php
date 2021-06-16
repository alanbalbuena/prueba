<h1>{{ $modo }} Chofer</h1>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach

    </ul>
</div>

@endif
<div class="form-group">
    <label for="">Nombre</label>
    <input class="form-control" placeholder="Escribe el nombre aqui" type="text" , name="nombre" , id="nombre" , value="{{ isset($chofer->nombre) ? $chofer->nombre : old('nombre')}}">
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Codigo</label>
        <input class="form-control" placeholder="Escribe el codigo aqui" type="text" , name="codigo" , id="codigo" , value="{{ isset($chofer->codigo) ? $chofer->codigo : old('codigo')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="">Porcentaje</label>
        <input class="form-control" placeholder="Escribe el porcentaje aqui" type="number" , name="porcentaje" , id="porcentaje" , value="{{ isset($chofer->porcentaje) ? $chofer->porcentaje : old('porcentaje')}}">
    </div>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }}">
<a class="btn btn-primary" href="{{ url('chofer/')}}">Regresar</a>
</div>