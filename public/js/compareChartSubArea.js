$(document).ready(function() 
{

   

/*Mostrar graficos y actualizarlos*/
 $("#select").click(function(){

        var myPromise = new Promise(function (resolve, reject) {

        var semester = $('select[name=semester]').val();
        var _token = $('input[name="_token"]').val();
        var subKnowledgeArea = $('select[name=subKnowledgeArea]').val();
        var subject = $('select[name=subject]').val();
        var question = $('select[name=question]').val();
          
        var response;

        $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: 'get_chart_compare_sub_area', // This is the url we gave in the route
                data: {'question':question, 'semester' : semester, '_token' : _token, 
                'subKnowledgeArea' : subKnowledgeArea, 'subject' : subject }, // a JSON object to send back
                success: function(response) { // What to do if we succeed

                    resolve(response);

                },

                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                
                   
                    reject('Page loaded, but status not OK.');
                }
            });
        });

        // Tell our promise to execute its code
        // and tell us when it's done.
            myPromise.then(function (result) {
            // Prints received JSON to the console.

                /*en caso de que haya un error de consulta se muestra un mensaje de error*/

                if(result["error-consulta"] == "error-consulta"){

                    $("#error-consulta").text("Esta Sub Área de Conocimiento no tiene aún evaluaciones registradas");

                    $("#error-consulta").fadeIn().delay(10000).fadeOut();

                     return ; 
                }


                if(result["error-data"] == "error-data"){

                        $("#error-consulta").text("Por favor compruebe que ha introducido los datos necesarios");

                         $("#error-consulta").fadeIn().delay(10000).fadeOut();

                         return ; 
                }


            var NameArea = result["NameArea"];
            
            var CountStudentsAnswered = result.CountStudentsAnswered;
           
            var CountStudentPercentage = result.CountStudentPercentage;

            var studentsUniverse = result.studentsUniverse;

            var CountAreaTeachers = result.CountAreaTeachers;


                        
            $('#count-content').remove(); // 

            $('#count-container').append('<div id="count-content"> Cantidad de estudiantes participantes: '+CountStudentsAnswered+'/'+studentsUniverse+'  ('+CountStudentPercentage+')</div>'); 

            /* EN CASO DE QUE SEA  LA EVALUACIÓN GLOBAL*/

            if ( result.type_request == "global" ) {

                var subjectName = result["SubjectName"];

                var AreaSum = result["prom_sum_option"];
                
                var prom_sub_area = result["prom_sub_area"];
                var label_sub_area = null;
                var subjectName = result["SubjectName"];


                if (prom_sub_area=="invalid"){
                    prom_sub_area = null;
                }else{
                    label_sub_area = "Profesores del Sub Área de Conocimiento"
                }

                $('#myChart').remove(); // this is my <canvas> element

                $('#question-content').remove(); // 

                $('#question-container').append('<div id="question-content"> </div>'); //
                
                $('#question-content').append
                                        ('<p> Evaluación de todos los ítems en los profesores que dictan la asignatura: <b>'+subjectName+ ' </b>perteneciente a la Sub Área de Conocimiento: <b>'+NameArea+'</b> respecto a los docentes de otras Sub Áreas</p>'); 
                
                $('#question-content').append
                                         ('<p class="count-teacher top-20"> Cantidad de Profesores de la Sub Área <b>'+NameArea+ '</b>: '+CountAreaTeachers+'</p>');   
         
                $('#graph-container').append('<canvas id="myChart"><canvas>');

                var canvas = document.getElementById('myChart');
                
                       var data = {

                       datasets: [

                        {
                        data: [AreaSum],
                        
                          label: ['"'+NameArea+'"'],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                            ],
                        },

                        {
                          data: [prom_sub_area],
                        
                          label: ["Profesores de otras Sub Áreas Conocimiento"],
                          backgroundColor: [
                               
                                'rgba(255,157,56,1)'
                            ],
                            borderColor: [
                                
                                'rgba(54, 162, 235, 1)'
                            ],
                        }

                        ]
                    };
                    

                 var myLineChart = new Chart(canvas,{
                   type:  'bar',
                   data:data,

                   options: {

                    scales: {
                            xAxes: [{ barPercentage: 0.5 }],
                             yAxes: [{
                                position: "left",
                                stacked: false,
                                scaleLabel: {
                                  display: true,
                                  labelString: "Promedio de Puntuaciones de Evaluación",
                                  fontFamily: "Montserrat",
                                  fontColor: "black",
                                  fontSize: 18
                                },

                                 ticks: {
                                    beginAtZero: true
                                }
                      
                            }],
                        }
                  }

                });

        }

         /* END  EN CASO DE QUE SEA  LA EVALUACIÓN GLOBAL*/


         /* EN  CASO DE QUE SEA  LA EVALUACIÓN DE UNA PREGUNTA ESPECÍFICA : */

            var question = result["question"];

            if ( result.type_request == "specific" ) {

                var subjectName = result["SubjectName"];

                var AreaSum = result["prom_sum_option"];
                var NameSubArea = result["NameArea"];
                var prom_sub_area = result["prom_sub_area"];
                var label_sub_area = null;
                var subjectName = result["SubjectName"];

                if (prom_sub_area=="invalid"){
                    prom_sub_area = null;
                }else{
                    label_sub_area = "Profesores del Sub Área de Conocimiento"
                }

                $('#myChart').remove(); // this is my <canvas> element

                $('#question-content').remove(); // 

                $('#question-container').append('<div id="question-content"> </div>'); //
                
            
                $('#question-content').append
                                        ('<p> Evaluación de los profesores que dictan la asignatura: <b>'+subjectName+ ' </b>,perteneciente a la Sub Área de Conocimiento: <b>'+NameArea+'</b> respecto a los docentes de otras Sub Áreas, para el ítem : </p><p><b>'+question+ '</b></p>'); 
                

                $('#question-content').append
                                         ('<p class="count-teacher top-20"> Cantidad de Profesores del Área <b>'+NameArea+ '</b>: '+CountAreaTeachers+'</p>'); 

                $('#graph-container').append('<canvas id="myChart"><canvas>');

                var canvas = document.getElementById('myChart');
            
                       var data = {

                       datasets: [

                        {
                        data: [AreaSum],
                        
                          label: ['"'+NameArea+'"'],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                            ],
                        },

                        {
                          data: [prom_sub_area],
                        
                        label: ["Profesores de otras Sub Áreas Conocimiento"],
                          backgroundColor: [
                               
                                'rgba(255,157,56,1)'
                            ],
                            borderColor: [
                                
                                'rgba(54, 162, 235, 1)'
                            ],
                        }

                        ]
                    };
                    
                     var myLineChart = new Chart(canvas,{
                   type:  'bar',
                   data:data,

                   options: {

                    scales: {
                            xAxes: [{ barPercentage: 0.5 }],
                             yAxes: [{
                                position: "left",
                                stacked: false,
                                scaleLabel: {
                                  display: true,
                                  labelString: "Promedio de Puntuaciones de Evaluación",
                                  fontFamily: "Montserrat",
                                  fontColor: "black",
                                  fontSize: 18
                                },

                                 ticks: {
                                    beginAtZero: true
                                }
                      
                            }],
                        }
                  }

                });


            }   

             // global vars
              
                 var winHeight = $("body").prop('scrollHeight');

                // set initial div height / width
                $('.resize-col').css({
                    'height': winHeight,
                });

                // make sure div stays full width/height on resize
                $(window).resize(function(){
                    $('.resize-col').css({
                    'height': winHeight,
                });
                });


         /**********************************************************/

        }, function (result) {
            // Prints "Aww didn't work" or
            // "Page loaded, but status not OK."
             
                $("#error-chart").fadeIn().delay(10000).fadeOut();
        });



    });


    /*Filtrar Opciones de búsqueda*/

    /*Por area de conocimiento*/
    $("#knowledgeArea").change(function(e){
        
        var knowledgeArea = this.value;
        var semesterId = $('select[name=semester]').val();
        $('#subKnowledgeArea').empty();
        $('#subject').empty();
        $('#teacher').empty();
        $('#section').empty();
        
        
        var _token = $('input[name="_token"]').val();
       
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: 'update_knowledgeArea', // This is the url we gave in the route
                data: {'knowledgeArea' : knowledgeArea,'semesterId': semesterId, '_token' : _token}, // a JSON object to send back
               
                success: function(response) { // What to do if we succeed

                    var subKnowledgeAreas = response.subKnowledgeAreas;
                    var subKnowledgeAreaIds = response.SubKnowledgeAreaIds;
                    var subjectNames = response.subjectNames;
                    var subjectsIds = response.subjectsIds;
                    var teachersNames = response.teachersNames;
                    var teachersIds = response.teachersIds;
                    var sections = response.sections;
                    var sectionsIds = response.sectionsIds;

                    $('#subKnowledgeArea')
                            .append($("<option></option>")
                            .attr("value","")
                            .text("Seleccione..")); 


                    for (var i = 0; i < subKnowledgeAreas.length; i++) {
                        $('#subKnowledgeArea')
                        .append($("<option></option>")
                        .attr("value",subKnowledgeAreaIds[i])
                        .text(subKnowledgeAreas[i])); 
                    }

                    $('#subject')
                            .append($("<option></option>")
                            .attr("value","")
                            .text("Seleccione..")); 


                    for (var i = 0; i < subjectNames.length; i++) {
                        $('#subject')
                        .append($("<option></option>")
                        .attr("value",subjectsIds[i])
                        .text(subjectNames[i])); 
                    }

                    for (var i = 0; i < teachersNames.length; i++) {
                        $('#teacher')
                        .append($("<option></option>")
                        .attr("value",teachersIds[i])
                        .text(teachersNames[i])); 
                    }

                    for (var i = 0; i < sections.length; i++) {
                        $('#section')
                        .append($("<option></option>")
                        .attr("value",sectionsIds[i])
                        .text(sections[i])); 
                    }
                

                },

                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                
                    console.log('Page loaded, but status not OK.');

                    $("#error-chart").css("display","block");

                    setTimeout(function() {
                          $("#error-chart").fadeOut().empty();
                        }, 5000);
                }
            });
       
        });

         /*Por sub area de conocimiento*/
        $("#subKnowledgeArea").change(function(e){
            
            var SubKnowledgeArea = this.value;

            $('#subject').empty();
            $('#teacher').empty();
            $('#section').empty();
            
            var semesterId = $('select[name=semester]').val();
            
            var _token = $('input[name="_token"]').val();
           
                $.ajax({
                    method: 'POST', // Type of response and matches what we said in the route
                    url: 'update_subKnowledgeArea', // This is the url we gave in the route
                    data: {'SubKnowledgeArea' : SubKnowledgeArea, '_token' : _token,'semesterId': semesterId}, // a JSON object to send back
                   
                    success: function(response) { // What to do if we succeed
                       
                        var subjectNames = response.subjectNames;
                        var subjectsIds = response.subjectsIds;
                        var teachersNames = response.teachersNames;
                        var teachersIds = response.teachersIds;
                        var sections = response.sectionName;
                        var sectionsIds = response.sectionId;


                        $('#subject')
                            .append($("<option></option>")
                            .attr("value","")
                            .text("Seleccione..")); 


                        for (var i = 0; i < subjectNames.length; i++) {
                            $('#subject')
                            .append($("<option></option>")
                            .attr("value",subjectsIds[i])
                            .text(subjectNames[i])); 
                        }

                        for (var i = 0; i < teachersNames.length; i++) {
                            $('#teacher')
                            .append($("<option></option>")
                            .attr("value",teachersIds[i])
                            .text(teachersNames[i])); 
                        }

                        for (var i = 0; i < sections.length; i++) {
                            $('#section')
                            .append($("<option></option>")
                            .attr("value",sectionsIds[i])
                            .text(sections[i])); 
                        }
                    

                    },

                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    
                        console.log('Page loaded, but status not OK.');
                    }
                });
           
            });


        /*Actualizar preguntas segun semestre de la encuesta*/

        $("#semester").change(function(e){
            
            var semester = this.value;

            $('#question').empty();
         
            var _token = $('input[name="_token"]').val();
           
                $.ajax({
                    method: 'POST', // Type of response and matches what we said in the route
                    url: 'update_questions', // This is the url we gave in the route
                    data: {'semester' : semester, '_token' : _token}, // a JSON object to send back
                   
                    success: function(response) { // What to do if we succeed
                       
                        var questionNames = response.questionNames;
                        var questionId = response.questionId;
                        

                        $('#question')
                            .append($("<option></option>")
                            .attr("value","")
                            .text("Seleccione.."));

                        $('#question')
                        .append($("<option></option>")
                        .attr("value","global-question")
                        .text("Evaluación de todos los ítems"));


                        for (var i = 0; i < questionNames.length; i++) {
                            $('#question')
                            .append($("<option></option>")
                            .attr("value",questionId[i])
                            .text(questionNames[i]));

                        }

                    },

                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    
                        console.log('Page loaded, but status not OK.');
                    }
                });
           
            });




});





