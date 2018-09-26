@extends('layouts.dashboard')
@section('content')

<div class="container-fluid homeIntranet">
    <div class="row text-center size-p" >
        <div class="col-xs-12">
            <h3 class="raleway bold">Encuestas</h3>
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
                <th>Nombre</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Finalización </th>
                <th>Estatus</th>
                <th>Configurar</th>
                <th>Editar preguntas</th>
                <th>Eliminar encuesta</th>
            </thead>
            @foreach($semesters as $semester)
                <tbody>
                    <td>{{$semester->name}} </td>
                        
                        @foreach($semester->survey as $attributes)
                            <td>{{$attributes->name}} </td>
                            <td>{{ date('d-m-Y', strtotime($attributes->pivot->start_date)) }} </td>
                            <td>{{ date('d-m-Y', strtotime($attributes->pivot->end_date)) }} </td>
                            @if($attributes->pivot->status=="1")
                                <td> <i class="fa fa-certificate survey-active"></i> ACTIVA </td>    
                            @elseif($attributes->pivot->status=="0")
                                <td> <i class="fa fa-certificate survey-disable"></i> INACTIVA </td>   
                            @else
                                <td> SIN DEFINIR </td>   
                            @endif
                        @endforeach

                    <td>    
                        {{ Html::linkAction('DashboardController@selectSurvey', '', array($semester->id), array('class'=>'glyphicon glyphicon-pencil ')) }}        
                    </td>
                    <td>    
                        {{ Html::linkAction('DashboardController@showQuestionsForm', '', array($semester->id), array('class'=>'glyphicon glyphicon-question-sign')) }}   
                    </td>
                    <td>    
                        {{ Html::linkAction('DashboardController@deleteSurveyMessage', '', array($semester->id), array('class'=>'glyphicon glyphicon-remove')) }}          
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>
     {{ $semesters->links() }}
</div>

@endsection
