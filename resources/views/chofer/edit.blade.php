@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/chofer/'.$chofer->id) }}" method="POST">
        @csrf
        {{ method_field('PATCH') }}
        @include('chofer.form',['modo'=>'Editar'])
    </form>
</div>
@endsection