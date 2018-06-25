@extends('layouts.general')
@section('content')

<div class="container register">
    <div class="row">
        <h1>El profesor {{$TeacherName}}  tiene la siguiente cantidad de opciones elegidas:</h1>

        <h2> Opcion 1: </h2>
            <p> {{$option1}}</p>
    
        <h2> Opcion 2: </h2>
            <p> {{$option2}}</p>

        <h2> Opcion 3: </h2>
            <p> {{$option3}}</p>

        <h2> Opcion 4: </h2>
            <p> {{$option4}}</p>

        <h2> Opcion 5: </h2>
            <p> {{$option5}}</p>
    </div>
</div>

@endsection