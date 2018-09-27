@extends('layouts.dashboard')
@section('content')

<div class="container-fluid homeIntranet">
    <div class="row text-center size-p">
        <div class="col-xs-12">
            <h3 class="raleway bold">Asignaturas</h3>
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
                <th>Nombre</th>
                <th>Semestre</th>
                <th>Eliminar </th>
            </thead>
            @foreach($subjects as $subject)
                <tbody>
                    <td>{{$subject->name}} </td>
                   <td>{{$subject->semester}}° </td>
                    <td>    
                        {{ Html::linkAction('DashboardController@deleteSubAreaSubject', '', array($subject->id), array('class'=>'glyphicon glyphicon-remove')) }}          
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>

    {{ Html::linkAction('DashboardController@editSubjectSubAreaForm', 'Editar asignaturas', array($subknowledgeArea_id), array('class'=>'btn btn-success add-more')) }}
    
    {{ $subjects->links() }}
</div>

@endsection