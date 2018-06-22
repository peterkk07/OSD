@extends('layouts.dashboard')
@section('content')

<div class="container-fluid homeIntranet">
    <div class="row text-center" >
        <div class="col-xs-12">
            <h3 class="raleway bold" style="color:black;">Áreas de Conocimiento</h3>
        </div>
        @if ($message = Session::get('success'))
            <div class="col-xs-12 alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p class="message">{{ $message }}</p>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <div style="overflow-x:auto;">
                <table class="table table-responsive top-30">
                    <thead>
                        <th>Nombre</th>
                        <th>Materias</th>
                        <th class="">Eliminar </th>
                    </thead>
                    @foreach($areas as $area)
                        <tbody>
                            <td>{{$area->name}} </td>
                            <td class= "">    
                                {{ Html::linkAction('DashboardController@viewSubject', '', array($area->id), array('class'=>'glyphicon glyphicon-pencil')) }}          
                            </td>
                            <td class= "">    
                                {{ Html::linkAction('DashboardController@deleteArea', '', array($area->id), array('class'=>'glyphicon glyphicon-remove')) }}          
                            </td>
                        </tbody>
                    @endforeach
                </table>


            </div>
        </div>
    </div>
     {{ $areas->links() }}
</div>

@endsection
