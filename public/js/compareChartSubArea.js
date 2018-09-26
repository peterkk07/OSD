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
          var graphtype = $('select[name=graphtype]').val();
        var response;

        $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: 'get_chart_compare_sub_area', // This is the url we gave in the route
                data: {'graphtype':graphtype, 'question':question, 'semester' : semester, '_token' : _token, 
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



            var CountStudentsAnswered = result.CountStudentsAnswered;
           
            var CountStudentPercentage = result.CountStudentPercentage;

            var rest ="";

            if (result["rest"]=="global"){
                rest = "Sub Áreas de Conocimiento restantes";
            }else{
                rest = "Profesores del Sub Área de Conocimiento";
            }
                           
            var graphtype = "";

            if (result["graphtype"]==""){
                graphtype = "pie";
            }else{
                graphtype = result["graphtype"];
            }                         

            $('#count-content').remove(); // 

            $('#count-container').append('<div id="count-content"> Cantidad de estudiantes encuestados: '+CountStudentsAnswered+'('+CountStudentPercentage+')</div>'); //

            /* EN CASO DE QUE SEA  LA EVALUACIÓN GLOBAL*/

            if ( result.type_request == "global" ) {

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
                

                if (subjectName=='global-subject'){
                   $('#question-content').append('<p> Evaluación global de sus materias dictadas en este período lectivo</p>');  
                }
                else{
                    $('#question-content').append('<p> Evaluación global de los profesores para la materia: "'+subjectName+'"</p>'); 
                }



                $('#graph-container').append('<canvas id="myChart"><canvas>');

                var canvas = document.getElementById('myChart');
                
                if (graphtype =="doughnut" || graphtype =="pie"){
                    
                    var data = {

                    labels: ['"'+NameSubArea+'"','"Sub Áreas de Conocimiento restantes"'],
                       datasets: [

                        {
                        data: [AreaSum,prom_sub_area],
                        
                          label: [NameSubArea],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                                'rgba(255,157,56,1)'
                               
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(255,99,132,1)'
                                
                            ],
                          
                        },

                        ]
                    };

                    }else {

                       var data = {

                       datasets: [

                        {
                        data: [AreaSum],
                        
                          label: ['"'+NameSubArea+'"'],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                            ],
                        },

                        {
                          data: [prom_sub_area],
                        
                          label: [rest],
                          backgroundColor: [
                               
                                'rgba(255,157,56,1)'
                            ],
                            borderColor: [
                                
                                'rgba(54, 162, 235, 1)'
                            ],
                        }

                        ]
                    };
                    }

                var myLineChart = new Chart(canvas,{
                    type:  graphtype,

                    data:data,
                    options: {

                    plugins: {
                          labels: {
                            // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                            render: 'percentage',

                            // precision for percentage, default is 0
                            precision: 0,

                            // identifies whether or not labels of value 0 are displayed, default is false
                            showZero: true,

                            // font size, default is defaultFontSize
                            fontSize: 55,

                            // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                            fontColor: '#fff',

                            // font style, default is defaultFontStyle
                            fontStyle: 'normal',

                            // font family, default is defaultFontFamily
                            fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                            // draw text shadows under labels, default is false
                            textShadow: true,

                            // text shadow intensity, default is 6
                            shadowBlur: 10,

                            // text shadow X offset, default is 3
                            shadowOffsetX: -5,

                            // text shadow Y offset, default is 3
                            shadowOffsetY: 5,

                            // text shadow color, default is 'rgba(0,0,0,0.3)'
                            shadowColor: 'rgba(255,0,0,0.75)',

                            // draw label in arc, default is false
                            arc: true,

                            // position to draw label, available value is 'default', 'border' and 'outside'
                            // default is 'default'
                            position: 'default',

                            // draw label even it's overlap, default is true
                            overlap: true,

                            // show the real calculated percentages from the values and don't apply the additional logic to fit the percentages to 100 in total, default is false
                            showActualPercentages: true,

                            // set images when `render` is 'image'
                            images: [
                              {
                                src: 'image.png',
                                width: 16,
                                height: 16
                              }
                            ],

                            // add padding when position is `outside`
                            // default is 2
                            outsidePadding: 4,

                            // add margin of text when position is `outside` or `border`
                            // default is 2
                            textMargin: 4
                          }
                        },
                   
                  /*  scales: {
                             yAxes: [{
                                position: "left",
                                stacked: true,
                                scaleLabel: {
                                  display: true,
                                  labelString: "Cantidad de Respuestas",
                                  fontFamily: "Montserrat",
                                  fontColor: "black",
                                  fontSize: 18
                                },
                      
                            }],
                        }*/
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
                
                $('#question-content').append('<p>'+question+'</p>'); //

                $('#graph-container').append('<canvas id="myChart"><canvas>');

                var canvas = document.getElementById('myChart');
                

                 if (graphtype =="doughnut" || graphtype =="pie"){
                    
                    var data = {

                    labels: ['"'+NameSubArea+'"',"Sub Áreas de Conocimiento restantes"],
                       datasets: [

                        {
                        data: [AreaSum,prom_sub_area],
                        
                          label: [NameSubArea],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                                'rgba(255,157,56,1)'
                               
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(255,99,132,1)'
                                
                            ],
                          
                        },

                        ]
                    };

                    }else {

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
                          data: [prom_area],
                        
                          label: [rest],
                          backgroundColor: [
                               
                                'rgba(255,157,56,1)'
                            ],
                            borderColor: [
                                
                                'rgba(54, 162, 235, 1)'
                            ],
                        }

                        ]
                    };
                    }

                    var myLineChart = new Chart(canvas,{
                    type:  graphtype,
                    data:data,
                    options: {

                    plugins: {
                          labels: {
                            // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                            render: 'percentage',

                            // precision for percentage, default is 0
                            precision: 0,

                            // identifies whether or not labels of value 0 are displayed, default is false
                            showZero: true,

                            // font size, default is defaultFontSize
                            fontSize: 55,

                            // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                            fontColor: '#fff',

                            // font style, default is defaultFontStyle
                            fontStyle: 'normal',

                            // font family, default is defaultFontFamily
                            fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                            // draw text shadows under labels, default is false
                            textShadow: true,

                            // text shadow intensity, default is 6
                            shadowBlur: 10,

                            // text shadow X offset, default is 3
                            shadowOffsetX: -5,

                            // text shadow Y offset, default is 3
                            shadowOffsetY: 5,

                            // text shadow color, default is 'rgba(0,0,0,0.3)'
                            shadowColor: 'rgba(255,0,0,0.75)',

                            // draw label in arc, default is false
                            arc: true,

                            // position to draw label, available value is 'default', 'border' and 'outside'
                            // default is 'default'
                            position: 'default',

                            // draw label even it's overlap, default is true
                            overlap: true,

                            // show the real calculated percentages from the values and don't apply the additional logic to fit the percentages to 100 in total, default is false
                            showActualPercentages: true,

                            // set images when `render` is 'image'
                            images: [
                              {
                                src: 'image.png',
                                width: 16,
                                height: 16
                              }
                            ],

                            // add padding when position is `outside`
                            // default is 2
                            outsidePadding: 4,

                            // add margin of text when position is `outside` or `border`
                            // default is 2
                            textMargin: 4
                          }
                        },
                   
                  /*  scales: {
                             yAxes: [{
                                position: "left",
                                stacked: true,
                                scaleLabel: {
                                  display: true,
                                  labelString: "Cantidad de Respuestas",
                                  fontFamily: "Montserrat",
                                  fontColor: "black",
                                  fontSize: 18
                                },
                      
                            }],
                        }*/
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

                    $('#subject')
                            .append($("<option></option>")
                            .attr("value","global-subject")
                            .text("Evaluación de todas las materias")); 

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

                        $('#subject')
                            .append($("<option></option>")
                            .attr("value","global-subject")
                            .text("Evaluación de todas las materias")); 

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
                        .text("Evaluación de todas las preguntas"));


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





