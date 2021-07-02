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
    <h1>Efectivo</h1>
    <a class="btn btn-success" href="{{ url('efectivo/create')}}">Nuevo Registro</a><br><br>
    <div class="table-responsive">
        <table class="table table-light table-sm table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>CANTIDAD</th>
                    <th>CONCEPTO</th>
                    <th>APLICACION</th>
                    <th>NOTA</th>
                    <th>FECHA</th>
                    <th>TIPO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($efectivos as $efectivo)
                <tr>
                    <td>{{ $efectivo->id }}</td>
                    <td>{{ $efectivo->cantidad }}</td>
                    <td>{{ $efectivo->concepto }}</td>
                    <td>{{ $efectivo->aplicacion }}</td>
                    <td>{{ $efectivo->nota }}</td>
                    <td>{{ $efectivo->created_at }}</td>
                    <td>{{ $efectivo->tipo }}</td>
                    <td><a class="btn btn-warning btn-sm" href="{{ url('/efectivo/'. $efectivo->id.'/edit')}}">Editar</a></td>
                    <td>
                        <form class="d-inline" action="{{ url('/efectivo/'.$efectivo->id) }}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <input class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Estas seguro que quieres eliminar?')" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $efectivos->links() !!}
    </div>
</div>
@endsection