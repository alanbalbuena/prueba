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
    <h1>Choferes</h1>
    <a class="btn btn-success" href="{{ url('chofer/create')}}">Nuevo Chofer</a><br><br>
    <div class="table-responsive">
        <table class="table table-light table-sm table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>NOMBRE</th>
                    <th>CODIGO</th>
                    <th>PORCENTAJE</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($choferes as $chofer)
                <tr>
                    <td>{{ $chofer->id }}</td>
                    <td>{{ $chofer->nombre }}</td>
                    <td>{{ $chofer->codigo }}</td>
                    <td>{{ $chofer->porcentaje }}</td>
                    <td><a class="btn btn-warning btn-sm" href="{{ url('/chofer/'. $chofer->id.'/edit')}}">Editar</a></td>
                    <td>
                        <form class="d-inline" action="{{ url('/chofer/'.$chofer->id) }}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <input class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Estas seguro que quieres eliminar?')" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $choferes->links() !!}
    </div>
</div>
@endsection