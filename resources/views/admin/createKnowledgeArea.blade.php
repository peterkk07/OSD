@extends('layouts.dashboard')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3 size-p">

                <h3 class="text-center">Crear Áreas de Conocimiento </h3>
            
            @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/agregar-areas') }}">
                {{ csrf_field() }}

                <label for="area[]" class="control-label raleway-semibold"></label>
                <div class="input-group control-group after-add-more has-error">

                    @foreach($errors->all() as $key=>$error) 
                        @if($errors->has('area.' . $key ))
                            <span class="help-block">
                                <strong>{{ $errors->first('area.'. $key) }}</strong>
                            </span>
                             @break
                        @endif
                    @endforeach
                    
                    <input type="text" name="area[]" class="form-control" placeholder="Introduza el Área de Cónocimiento">

                    <div class="input-group-btn btn-bottom"> 
                        <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
                    </div>
                    
                </div>
                <div class="form-group text-center top-20">
                    <a href= "{{ url('/dashboard') }}">
                        <button class="btn btn-primary button-form" type="button">Cancelar</button>
                    </a>
                 <button type="submit" class="btn btn-primary button-form">Crear</button>
               </div>
            </form>
            <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
             <div class="copy-fields hide">
                <div class="control-group input-group" style="margin-top:10px">
                   <input type="text" name="area[]" class="form-control" placeholder="Introduza el Área de Conocimiento">
                   <div class="input-group-btn"> 
                     <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Eliminar</button>
                   </div>
                </div>
             </div>
        </div>
    </div>
      
</div>
@endsection