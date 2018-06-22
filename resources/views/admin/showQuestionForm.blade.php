@extends('layouts.dashboard')
@section('content')

<div class="container-fluid homeIntranet">
    <div class="row text-center" >
        <div class="col-xs-12">
            <h3 class="raleway bold" style="color:black;">Preguntas</h3>
        </div>
        @if ($message = Session::get('success'))
            <div class="col-xs-12 alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p class="message">{{ $message }}</p>
            </div>
        @endif
    </div>

    <div style="overflow-x:auto;">

        <table class="table table-responsive top-30">

            <thead>
                <th>Período lectivo</th>
                <th>Preguntas</th>
                <th>Eliminar </th>
            </thead>
            @foreach($questions as $question)
                <tbody>
                    <td>{{$semester}} </td>
                    <td>{{$question->description}} </td>
                    <td>    
                        {{ Html::linkAction('DashboardController@deleteUserMessage', '', array($question->id), array('class'=>'glyphicon glyphicon-remove')) }}   
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>

     {{ Html::linkAction('DashboardController@editQuestionsForm', 'Agregar o editar preguntas', array($survey_id), array('class'=>'btn btn-success add-more')) }}
     {{ $questions->links() }}
</div>

@endsection