@extends('layouts.finish')

@section('content')

<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-8 col-xs-offset-1 col-sm-offset-2 size-final">
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('error'))
               <div class="col-xs-12 alert alert-error">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

            <h3 class="text-center">Ha concluido el proceso</h3>

            <h3 class="text-center">Agradecemos tu participación</h3>
          
        </div>
    </div>
</div>
@endsection
