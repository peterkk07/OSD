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
        <div class="col-xs-11 col-xs-offset-1">
            <div style="overflow-x:auto;" id="vectorLayerslist">
                
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-xs-11 col-xs-offset-1">
            <div style="overflow-x:auto;">
                <table class="table table-responsive top-30">
                    <thead>
                        <th>Número de Pregunta</th>
                        <th>Completamente en desacuerdo</th>
                        <th>En desacuerdo</th>
                        <th>Ni de acuerdo ni en desacuerdo</th>
                        <th>De acuerdo</th>
                        <th>Completamente de acuerdo</th>
                    </thead>
            
                    <tbody>
                        <td> 55</td>
                        <td> 70</td>
                        <td> 45</td>
                        <td> 44</td>
                        <td> 80</td>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
    <div class="row">
            <div class="col-xs-11 col-xs-offset-1">
                <div style="overflow-x:auto;">
                    <table class="table table-responsive top-30">
                        <thead>
                            <tr> 
                            <th>Número de Pregunta</th>
                            <th>Completamente en desacuerdo</th>
                            <th>En desacuerdo</th>
                            <th>Ni de acuerdo ni en desacuerdo</th>
                            <th>De acuerdo</th>
                            <th>Completamente de acuerdo</th>
                        </tr>
                        </thead>
                 
                            <tbody>
                                <tr>
                                    <td> 55</td>
                                    <td> 70</td>
                                    <td> 45</td>
                                    <td> 44</td>
                                    <td> 80</td>
                                </tr>
                               
                            </tbody>
                    
                    </table>


                </div>
            </div>
        </div>
    </div>

@endsection
