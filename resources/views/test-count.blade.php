@extends('layouts.general')
@section('content')
<div class="container">
    <div class="row">
    
        <h2>El número de veces que la opción  {{$opciones}} fue seleccionada para esta respuesta es de :  </h2>


        <h3 class="text-center">{{$cantidad}}</h3>
    </div>
</div>
@endsection