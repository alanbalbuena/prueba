@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/prestamo') }}" method="POST">
        @csrf
        @include('prestamo.form',['modo'=>'Crear'])
    </form>
</div>
@endsection