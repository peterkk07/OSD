@extends('layouts.general')
@section('content')


 <div class="contenido">
        <div class="interna">
            
             PEDRO
        </div>

    </div>
<div class="container">







    <div class="row">
        <div class="col-xs-10 col-sm-6 col-xs-offset-1 col-sm-offset-3">
            <h3 class="text-center">Consultar  número de respuestas  </h3>
           
              @if(Session::has('error-carga'))
                     <p class="alert {{ Session::get('alert-class', 'alert-info') }} p-error">{{ Session::get('error-carga') }}</p>
                @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/test-select') }}" enctype="multipart/form-data" accept-charset="UTF-8">
                
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="pregunta" class="control-label raleway-semibold">Pregunta</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <select name="pregunta" size="1" maxlength="1" class="form-control">
                                @if(old('pregunta'))
                                    <option value="{{ old('pregunta') }}">{{ old('account-number') }}</option>
                                @else
                                      @foreach($preguntas as $pregunta)
                                        <option value="{{$pregunta->id}}">{{$pregunta->description}}</option>
                                      @endforeach
                            
                                @endif
                               
                            </select>
                            @if ($errors->has('pregunta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pregunta') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="opcion" class="control-label raleway-semibold">Opción de respuesta</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <select name="opcion" size="1" maxlength="1" class="form-control">
                                @if(old('pregunta'))
                                    <option value="{{ old('opcion') }}">{{ old('account-number') }}</option>
                                @else
                                      @foreach($opciones as $opcion)
                                        <option value="{{$opcion->description}}">{{$opcion->description}}</option>
                                      @endforeach
                            
                                @endif
                               
                            </select>
                            @if ($errors->has('opcion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('opcion') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group row buttons">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-register">
                            Consultar respuestas
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection