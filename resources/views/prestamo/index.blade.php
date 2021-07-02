@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
    <h1>Prestamos</h1>
    <a class="btn btn-success" href="{{ url('prestamo/create')}}">Nuevo Prestamo</a><br><br>
    <div class="table-responsive">
        <table class="table table-light table-sm table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>CANTIDAD</th>
                    <th>CHOFER</th>
                    <th>ENTREGO</th>
                    <th>ESTATUS</th>
                    <th>FECHA</th>
                    <th>PAGO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestamos as $prestamo)
                <tr>
                    <td>{{ $prestamo->id }}</td>
                    <td>{{ $prestamo->cantidad }}</td>
                    <td>{{ $prestamo->chofer }}</td>
                    <td>{{ $prestamo->entrego }}</td>
                    <td>{{ $prestamo->estatus }}</td>
                    <td>{{ $prestamo->fechaPrestamo }}</td>
                    <td>{{ $prestamo->fechaPago }}</td>
                    <td><a class="btn btn-warning btn-sm" href="{{ url('/prestamo/'. $prestamo->id.'/edit')}}">Editar</a></td>
                    <td>
                        <form class="d-inline" action="{{ url('/prestamo/'.$prestamo->id) }}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <input class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Estas seguro que quieres eliminar?')" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $prestamos->links() !!}
    </div>
</div>
@endsection