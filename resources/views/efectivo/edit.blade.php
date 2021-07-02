@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/efectivo/'.$efectivo->id) }}" method="POST">
        @csrf
        {{ method_field('PATCH') }}
        @include('efectivo.form',['modo'=>'Editar'])
    </form>
</div>
@endsection