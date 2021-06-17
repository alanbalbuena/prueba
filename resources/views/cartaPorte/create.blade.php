@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/cartaPorte') }}" method="POST">
        @csrf
        @include('cartaPorte.form',['modo'=>'Crear'])
    </form>
</div>
@endsection