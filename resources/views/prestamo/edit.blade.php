@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/prestamo/'.$prestamo->id) }}" method="POST">
        @csrf
        {{ method_field('PATCH') }}
        @include('prestamo.form',['modo'=>'Editar'])
    </form>
</div>
@endsection