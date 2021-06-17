@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/cartaPorte/'.$cartaPorte->id) }}" method="POST">
        @csrf
        {{ method_field('PATCH') }}
        @include('cartaPorte.form',['modo'=>'Editar'])
    </form>
</div>
@endsection