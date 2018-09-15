@extends('layouts.dashboard')
@section('content')

<div class="container-fluid homeIntranet">
    <div class="row text-center size-p">
        <div class="col-xs-12">
            <h3 class="raleway bold">Usuarios con rol "{{$rol}}"</h3>
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
                <th>Cedula</th>
                <th>Correo</th>
                <th>Editar </th>
                <th>Eliminar </th>
            </thead>
            @foreach($users as $user)
                <tbody>
                    <td>{{$user->name}} </td>
                    <td>{{$user->ci}} </td>
                    <td>{{$user->email}} </td>
                    <td>    
                        {{ Html::linkAction('DashboardController@editUserForm', '', array($user->id), array('class'=>'glyphicon glyphicon-pencil ')) }}          
                    </td>
                    <td>    
                        {{ Html::linkAction('DashboardController@deleteUserMessage', '', array($user->id), array('class'=>'glyphicon glyphicon-remove')) }}          
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>
    {{--  {{ $users->links() }}
 --}}
     {{ $users->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}


     
</div>

@endsection
