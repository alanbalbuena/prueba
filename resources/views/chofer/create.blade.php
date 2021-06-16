@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/chofer') }}" method="POST">
        @csrf
        @include('chofer.form',['modo'=>'Crear'])
    </form>
</div>
@endsection