@extends('layouts.general')
@section('content')

<div class="container register">
    <div class="row">
    <div class="col-lg-10">
        <h1>El profesor {{$TeacherName}}  tiene la siguiente cantidad de opciones elegidas:</h1>

<canvas id="myChart" width="400" height="200"></canvas>
    </div>


{!! $options[0] !!}

</div>



@endsection

@section('scripts')
<script type="text/javascript" src="{!! asset('js/Chart.min.js') !!}"></script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Option 1", "Option 2", "Option 3", "Option 4", "Option 5"],
        datasets: [{
            label: 'Catidad por opción',
            data: {{ json_encode($options) }},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@endsection