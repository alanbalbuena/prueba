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
    <h1>Facturadas</h1>
    <a class="btn btn-success" href="{{ url('cartaPorte/create')}}" hidden>Nuevo Registro</a><br><br>
    <form class="form-inline" action="{{ url('/buscar')}}" type="POST">        
        <input class="form-control mb-2 mr-sm-2" type="text" id="texto" placeholder="Buscar registro" name="texto" value="{{ isset($texto) ? $texto : old('texto')}}">
        <button class="btn btn-primary mb-2" type="submit">Buscar</button>
    </form>
    <div class="table-responsive">
        <table class="table table-hover table-light table-sm">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>TONELADAS</th>
                    <th>$TON</th>
                    <th>$SEG</th>
                    <th>CHOFER</th>
                    <th>EMPRESA</th>
                    <th>CP</th>
                    <th>SUBTOTAL</th>
                    <th>ENTREGADO</th>
                    <th>TRANSFERENCIA</th>
                    <th>DISEL</th>
                    <th>FECHA</th>
                    <th>FACTURA</th>
                    <th>REFACTURA</th>
                    <th>REMISION</th>
                    <th>ENTREGA</th>
                    <th>ESTATUSPAGO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartaPortes as $cartaPorte)
                <tr class="{{ $cartaPorte->estatusPago == 'PAGADA' ? 'table-success' : ($cartaPorte->estatusPago == 'CANCELADA' ? 'table-danger': '')}}">
                    <td> {{ $cartaPorte->id }} </td>
                    <td> {{ $cartaPorte->toneladas }}</td>
                    <td> {{ $cartaPorte->precioPorTonelada }}</td>
                    <td> {{ $cartaPorte->precioPorSeguro }}</td>
                    <td> {{ $cartaPorte->chofer }}</td>
                    <td> {{ $cartaPorte->empresa }}</td>
                    <td> {{ $cartaPorte->identificadorCartaPorte }}</td>
                    <td> {{ $cartaPorte->totalFlete }}</td>
                    <td> {{ $cartaPorte->totalEntregado }}</td>
                    <td> {{ $cartaPorte->transferencia }}</td>
                    <td> {{ $cartaPorte->totalDisel }}</td>
                    <td> {{ $cartaPorte->fecha }}</td>
                    <td> {{ $cartaPorte->factura }}</td>
                    <td> {{ $cartaPorte->reFactura }}</td>
                    <td> {{ $cartaPorte->remision }}</td>
                    <td> {{ $cartaPorte->entrega }}</td>
                    <td> {{ $cartaPorte->estatusPago }}</td>
                    <td><a class="btn btn-warning btn-sm" href="{{ url('/cartaPorte/'. $cartaPorte->id.'/edit')}}">Editar</a></td>
                    <td>
                        <form action="{{ url('/cartaPorte/'.$cartaPorte->id) }}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <input class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Estas seguro que quieres eliminar?')" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {!! $cartaPortes->links() !!}
    </div>
</div>
@endsection