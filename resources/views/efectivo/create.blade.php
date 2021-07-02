@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/efectivo') }}" method="POST">
        @csrf
        @include('efectivo.form',['modo'=>'Crear'])
    </form>
</div>
@endsection