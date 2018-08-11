@extends('layouts.general')
@section('content')

<div class="container register">
    <div class="row">
    <div class="col-lg-10">
        <h1>El profesor {{$TeacherName}}  tiene la siguiente cantidad de opciones elegidas:</h1>

<canvas id="myChart" width="400" height="200"></canvas>
    </div>
<input type="button" value="Add Data" onclick="adddata()">

<input type="button" id="select">


{!! $options !!}

</div>



@endsection

@section('scripts')
<script type="text/javascript" src="{!! asset('js/Chart.min.js') !!}"></script>


<script>

$("#select").click(function(){

	
	var cars = [3,6,3,3,4];
    var canvas = document.getElementById('myChart');
	var data = {

        labels: ["pregunta 1", "pregunta 2", "pregunta 3", "pregunta 4", "pregunta 5", "pregunta 6", 

                "pregunta 7","pregunta 8","pregunta 9","pregunta 10","pregunta 11","pregunta 12","pregunta 13",

                "pregunta 14","pregunta 15","pregunta 16","pregunta 17","pregunta 18","pregunta 19"

                ],
        datasets: [ {
          type: 'bar',
          label: 'Dataset 1',
          backgroundColor: "red",
          data: [65, 10, 80, 81, 56, 85, 40, 10, 25 ,10, 25 ,26 ,28 ,27 ,28 ,29 ,40 , 50 ,60]
        }, {
          type: 'bar',
          label: 'Dataset 3',
          backgroundColor: "blue",
          data: [65, 10, 80, 81, 56, 85, 40, 10, 25 ,10, 25 ,26 ,28 ,27 ,28 ,29 ,40 , 50 ,60]
        }



        ]
    };

	function adddata(){
	  myLineChart.data.datasets[0].data[4] = 60;
	  myLineChart.data.labels[5] = "Newly Added";
	  myLineChart.update();
	}

	var option = {
	    showLines: true
	};


	var myLineChart = Chart.Bar(canvas,{

	   data:data,
	   options: {
        scales: {
          xAxes: [{
            stacked: true
          }],
          yAxes: [{
            stacked: true
          }]
        }
      }
	});
});
</script>







{{-- <script>
var canvas = document.getElementById('myChart');
var data = {

    labels: ["Option 1", "Option 2", "Option 3", "Option 4", "Option 5"],
    datasets: [{
            label: 'Catidad por opción',
            data: {{$options }},
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
};

function adddata(){
  myLineChart.data.datasets[0].data[4] = 60;
  myLineChart.data.labels[5] = "Newly Added";
  myLineChart.update();
}

var option = {
    showLines: true
};


var myLineChart = Chart.Bar(canvas,{

   data:data,
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

</script> --}}





@endsection