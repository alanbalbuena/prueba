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
    <h1>Sin Facturar {{ request()->segment(count(request()->segments())) }}</h1>
    <a class="btn btn-success" href="{{ url('cartaPorte/create')}}">Nuevo Registro</a>
    <a class="btn btn-primary" href="{{ url('sinFacturar/empresa')}}">EMPRESA</a>
    <a class="btn btn-primary" href="{{ url('sinFacturar/chio')}}">CHIO</a>
    <a class="btn btn-primary" href="{{ url('sinFacturar/edgar')}}">EDGAR</a>
    <a class="btn btn-primary" href="{{ url('sinFacturar/angel')}}">ANGEL</a>
    <a class="btn btn-primary" href="{{ url('sinFacturar/nadie')}}">NADIE</a><br><br>
    <table class="table table-hover table-sm table-responsive table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>EMPRESA</th>
                <th>ENTREGA</th>
                <th>CP</th>
                <th>REMISION</th>
                <th>CHOFER</th>
                <th>TONS</th>
                <th>$/TON</th>
                <th>$/SEG</th>
                <th>FLETE</th>
                <th>ENTREGADO</th>
                <th>ASIGNADO</th>
                <th>FACTURA</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartaPortes as $cartaPorte)
            <tr>
                <td> {{ $cartaPorte->id }} </td>
                <td> {{ $cartaPorte->empresa }} </td>
                <td> {{ $cartaPorte->entrega }} </td>
                <td> {{ $cartaPorte->identificadorCartaPorte }} </td>
                <td> {{ $cartaPorte->remision }} </td>
                <td> {{ $cartaPorte->chofer }} </td>
                <td> {{ $cartaPorte->toneladas }} </td>
                <td> {{ $cartaPorte->precioPorTonelada }} </td>
                <td> {{ $cartaPorte->precioPorSeguro }} </td>
                <td> {{ $cartaPorte->totalFlete }} </td>
                <td> {{ $cartaPorte->totalEntregado }} </td>
                <td> {{ $cartaPorte->asignado }} </td>
                <td> {{ $cartaPorte->factura }} </td>
                <td><a class="btn btn-warning btn-sm" href="{{ url('/cartaPorte/'. $cartaPorte->id.'/edit')}}">Editar</a></td>
                <td>
                    <form class="d-inline" action="{{ url('/cartaPorte/'.$cartaPorte->id) }}" method="POST">
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
    <H1>Saldo : $ {{ $dinero }}</H1>
</div>
@endsection