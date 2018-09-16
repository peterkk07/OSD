<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>OSD</title>

       <!-- Fonts -->
   
    
    
    <link href="{{public_path('css/style.css')}}"  rel="stylesheet" type="text/css">

    {{-- <link href="http://localhost:8000/css/style.css"  rel="stylesheet" type="text/css"> --}}



   {{--  <link href="http://localhost:8000/css/bootstrap.min.css"  rel="stylesheet" type="text/css"> --}}
   {{-- 
    <script src="http://localhost:8000/js/jquery-min.js" type="text/javascript"></script>  

    <script src="http://localhost:8000/js/bootstrap.min.js"></script> 
    <script src="http://localhost:8000/js/Chart.min.js" type="text/javascript" "></script> --}} 


   {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"> --}}
   {{--  <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">  --}}
</head>


<body>
    
    <h1>aca </h1>
   {{--  <div class="container register">
        <div class="row">
            <div class="col-xs-12 size-p">
                <h3 class="text-center">Elija el tipo de usuario que desea visualizar</h3>

                 <img src="/img/logos/logo-ucv.png" />
            </div>
        </div>

        <div id="count-container" class = "top-30">
            <div id="count-content">
                  
            </div>      
        </div>


        <div id="question-container" class = "top-30">
            <div id="question-content">
                  
            </div>      
        </div>


        <div class="row top-30">
            <div id="graph-container">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-4 col-sm-2">
                <div style="overflow-x:auto;">
                    <div id="label1" class="label-table top-30"></div>
                    <div class="table-container1"></div>
                </div>
            </div>
            <div class="col-xs-4 col-sm-5">
                <div style="overflow-x:auto;">
                    <div id="label2" class="label-table background top-30">Cantidad</div>
                    <div class="table-container2"></div>
                </div>
            </div>
             <div class="col-xs-4 col-sm-5">
                 <div style="overflow-x:auto;">
                    <div id="label3" class="label-table background top-30">Porcentaje</div>
                    <div class="table-container3"></div>
                </div>
            </div>
        </div>
  
    </div>

    <canvas id="myChart" width="400" height="200"></canvas>
    
    <input type="button" value="Add Data" onclick="adddata()">

    <input type="button" id="select"> --}}
    
  {{--  <script>



    
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

</script>
 --}}




    
     




    














   {{--  <script src="{{ elixir('js/all.js') }}"></script>  --}}
   {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> --}}

   {{--  <script type="text/javascript" src="{!! asset('js/jquerymask.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('js/menu.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('js/Chart.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/displayChart.js') !!}"></script> --}}
</body>
</html>

















































