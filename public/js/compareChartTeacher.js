$(document).ready(function() 
{


/*Mostrar graficos y actualizarlos*/
 $("#select").click(function(){

        var myPromise = new Promise(function (resolve, reject) {

        var semester = $('select[name=semester]').val();
        var _token = $('input[name="_token"]').val();
        var knowledgeArea = $('select[name=knowledgeArea]').val();
        var subject = $('select[name=subject]').val();
        var teacher_id = $('select[name=teacher]').val();
        var section = $('select[name=section]').val();
        var question = $('select[name=question]').val();
        var graphtype = $('select[name=graphtype]').val();
        

        var response;

        $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: 'get_chart_compare_teacher', // This is the url we gave in the route
                data: {'graphtype':graphtype,'question':question, 'section': section, 'semester' : semester, '_token' : _token, 
                'knowledgeArea' : knowledgeArea, 'subject' : subject, 'teacher' : teacher_id }, // a JSON object to send back
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

                         $("#error-consulta").fadeIn().delay(10000).fadeOut();

                         return ; 
                }

                /*cantidad de estudiantes encuestados */


            var CountStudentsAnswered = result.CountStudentsAnswered;
           
            var CountStudentPercentage = result.CountStudentPercentage;

            var graphtype = "";

            if (result["graphtype"]==""){
                graphtype = "bar";
            }else{
                graphtype = result["graphtype"];
            }
                     

            $('#count-content').remove(); // 

            $('#count-container').append('<div id="count-content"> Cantidad de estudiantes encuestados: '+CountStudentsAnswered+'('+CountStudentPercentage+')</div>'); //

            /* EN CASO DE QUE SEA  LA EVALUACIÓN GLOBAL*/

            if ( result.type_request == "global" ) {

                var subjectName = result["SubjectName"];
                var TeacherName = result["TeacherName"];
                var TeacherSum = result["prom_sum_option"];
                var prom_area = result["prom_area"];
                var prom_sub_area = result["prom_sub_area"];
                var label_area = null;
                var label_sub_area = null;


                if (prom_area=="invalid"){
                    prom_area = null;
                }else{
                    label_area = "Profesores del Área de Conocimiento";
                }

                if (prom_sub_area=="invalid"){
                    prom_sub_area = null;
                }else{
                    label_sub_area = "Profesores del Sub Área de Conocimiento";
                }

                $('#myChart').remove(); // this is my <canvas> element

                $('#question-content').remove(); // 

                $('#question-container').append('<div id="question-content"> </div>'); //
                
                $('#question-content').append('<p> Valoración del profesor para la materia: "'+subjectName+'"</p>'); //


                $('#graph-container').append('<canvas id="myChart"><canvas>');

                var canvas = document.getElementById('myChart');
                

                if ( prom_area == null){


                    if (graphtype =="doughnut" || graphtype =="pie"){
                    
                    var data = {

                    labels: ['"'+TeacherName+'"','"'+label_sub_area+'"'],
                       datasets: [

                        {
                        data: [TeacherSum,prom_sub_area],
                        
                          label: [TeacherName],
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

                        data: [TeacherSum],
                        
                          label: ['"'+TeacherName+'"'],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                              
                               
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                
                            ],
                          
                        },

                        {
                          data: [prom_sub_area],
                        
                          label: [label_sub_area],
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

                }


                if ( prom_sub_area == null){


                    if (graphtype =="doughnut" || graphtype =="pie"){
                    
                    var data = {

                    labels: ['"'+TeacherName+'"','"'+label_area+'"'],
                       datasets: [

                        {
                        data: [TeacherSum,prom_area],
                        
                          label: [TeacherName],
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

                        data: [TeacherSum],
                        
                          label: ['"'+TeacherName+'"'],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                              
                               
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                
                            ],
                          
                        },

                        {
                          data: [prom_area],
                        
                          label: [label_area],
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

                }


                if ( (prom_sub_area != null) && (prom_area != null) ){

                var data = {

                     labels: ['"'+TeacherName+'"',label_sub_area,label_area],

                        datasets: [ {
                         /* type: 'bar',*/
                       /*   label: 'Dataset 1',*/
                          backgroundColor: [
                                    'rgba(195,59,59,0.85)',
                                    'rgba(255,157,56,1)',
                                    'rgba(255,221,56,1)'
                                ],
                          data: [TeacherSum,prom_sub_area,prom_area],
                          fill: false
                        }

                        ]
                    };

                }

                var myLineChart = new Chart(canvas,{
                   type:  graphtype,
                   data:data,
                   options: {
                    scales: {
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
                        }
                  }
                });


            /**********************************************************/


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
              
              /*End ajustar alto de pantalla */   
        }

         /* END  EN CASO DE QUE SEA  LA EVALUACIÓN GLOBAL*/


         /* EN  CASO DE QUE SEA  LA EVALUACIÓN DE UNA PREGUNTA ESPECÍFICA : */

            var question = result["question"];

            if ( result.type_request == "specific" ) {

                var TeacherName = result["TeacherName"];
                var TeacherSum = result["prom_sum_option"];
                var prom_area = result["prom_area"];
                var prom_sub_area = result["prom_sub_area"];
                var label_area = null;
                var label_sub_area = null;

                if (prom_area=="invalid"){
                    prom_area = null;
                }else{
                    label_area = "Profesores del Área de Conocimiento"
                }

                if (prom_sub_area=="invalid"){
                    prom_sub_area = null;
                }else{
                    label_sub_area = "Profesores del Sub Área de Conocimiento"
                }

                
                $(".label-table").css("display","none"); 

                $('.table-container1').remove();
               
                $('.table-container2').remove();
               
                $('.table-container3').remove();

                $('#myChart').remove(); // this is my <canvas> element

                $('#question-content').remove(); // 

                $('#question-container').append('<div id="question-content"> </div>'); //
                
                $('#question-content').append('<p>'+question+'</p>'); //

                $('#graph-container').append('<canvas id="myChart"><canvas>');

                var canvas = document.getElementById('myChart');


                   if ( prom_area == null){

                    if (graphtype =="doughnut" || graphtype =="pie"){

                        var data = {

                            labels: ['"'+TeacherName+'"','"'+label_sub_area+'"'],
                            datasets: [

                            {
                            data: [TeacherSum,prom_sub_area],
                            
                              label: [TeacherName],
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


                    }else{


                        var data = {

 
                       datasets: [

                        {
                        data: [TeacherSum],
                        
                          label: ['"'+TeacherName+'"'],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                              
                               
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                
                            ],
                          
                        },

                        {
                          data: [prom_sub_area],
                        
                          label: [label_sub_area],
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

                }


                if ( prom_sub_area == null){

                    if (graphtype =="doughnut" || graphtype =="pie"){

                        var data = {

                            labels: ['"'+TeacherName+'"','"'+label_area+'"'],
                            datasets: [

                            {
                            data: [TeacherSum,prom_area],
                            
                              label: [TeacherName],
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


                    }else{


                        var data = {

 
                       datasets: [

                        {
                        data: [TeacherSum],
                        
                          label: ['"'+TeacherName+'"'],
                          backgroundColor: [
                                'rgba(195,59,59,0.85)',
                              
                               
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                
                            ],
                          
                        },

                        {
                          data: [prom_area],
                        
                          label: [label_area],
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

                }

                if ( (prom_sub_area != null) && (prom_area != null) ){
                var data = {

                     labels: ['"'+TeacherName+'"',label_sub_area,label_area],

                        datasets: [ {
                          type: 'bar',
                          label: 'Dataset 1',
                          backgroundColor: [
                                    'rgba(195,59,59,0.85)',
                                    'rgba(255,157,56,1)',
                                    'rgba(255,221,56,1)'
                                ],
                          data: [TeacherSum,prom_sub_area,prom_area],
                          fill: false
                        }

                        ]
                    };

                }

                var myLineChart = new Chart(canvas,{
                  type:  graphtype,
                   data:data,
                   options: {
                    scales: {
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
                        }
                  }
                });



                 /*Ajustar alto de pantalla */

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
              
              /*End ajustar alto de pantalla */  
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
            console.error(result); 
             
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
                            .text("Seleccione...")); 

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



        /*Por materias*/

        $("#subject").change(function(e){

                var subject = this.value;

                $('#teacher').empty();
                $('#section').empty();
                var semesterId = $('select[name=semester]').val();
            

                $("div#selectionArea select#knowledgeArea option").each(function(){          
                    
                    $(this).attr("selected",false);  
                    $(this).prop("selected",false);             
                 });  

                $("div#selectionSubArea select#subKnowledgeArea option").each(function(){      
                    
                    $(this).attr("selected",false); 
                    $(this).prop("selected",false);           
                }); 


                var myPromise = new Promise(function (resolve, reject) {

                var Subject = subject;
                
                var _token = $('input[name="_token"]').val();

                var response;

                $.ajax({
                         method: 'POST', // Type of response and matches what we said in the route
                        url: 'update_subject', // This is the url we gave in the route
                        data: {'semesterId':semesterId, 'Subject' : Subject, '_token' : _token}, // a JSON object to send back
                   
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

                    var knowledgeAreaId = result.knowledgeAreaId;
                    var knowledgeAreaName = result.knowledgeAreaName;
                       
                    var subknowledgeAreaId = result.subknowledgeAreaId;
                    var subknowledgeAreaName = result.subknowledgeAreaName;

                    var teachersId = result.teachersId;

                    var teachersNames = result.teachersNames;

                    var sections = result.sectionName;
                    var sectionsIds = result.sectionId;

                    $("div#selectionArea select#knowledgeArea option").each(function(){
                        
                        if($(this).val()== knowledgeAreaId){ // EDITED THIS LINE
                            $(this).attr("selected",true);
                            $(this).prop("selected",true);   
                        }
                    });  

                    $("div#selectionSubArea select#subKnowledgeArea option").each(function(){
                      
                        if($(this).val()== subknowledgeAreaId){
                            $(this).attr("selected",true);
                            $(this).prop("selected",true);
                        }
                    });  


                    for (var i = 0; i < teachersNames.length; i++) {
                        $('#teacher')
                        .append($("<option></option>")
                        .attr("value",teachersId[i])
                        .text(teachersNames[i])); 
                    }


                    for (var i = 0; i < sections.length; i++) {
                            $('#section')
                            .append($("<option></option>")
                            .attr("value",sectionsIds[i])
                            .text(sections[i])); 
                    }



            }, function (result) {
                // Prints "Aww didn't work" or
                // "Page loaded, but status not OK."
                console.error(result); 
            });
               
        });


         /*Por profesor*/

        $("#teacher").change(function(e){
            
            var TeacherId = this.value;

            $('#subject').empty();
            $('#knowledgeArea').empty();
            $('#subKnowledgeArea').empty();
            $('#section').empty();
            
            var _token = $('input[name="_token"]').val();
           
                $.ajax({
                    method: 'POST', // Type of response and matches what we said in the route
                    url: 'update_teacher', // This is the url we gave in the route
                    data: {'TeacherId' : TeacherId, '_token' : _token}, // a JSON object to send back
                   
                    success: function(response) { // What to do if we succeed
                       
                        var knowledgeAreaIds = response.knowledgeAreaIds;
                        var knowledgeAreaNames = response.knowledgeAreaNames;
                        var subKnowledgeAreaIds = response.subKnowledgeAreaIds;
                        var subKnowledgeAreaNames = response.subKnowledgeAreaNames;
                        var subjectNames = response.subjectNames;
                        var subjectIds = response.subjectIds;
                        var sections = response.sectionName;
                        var sectionsIds = response.sectionId;


                        for (var i = 0; i < knowledgeAreaIds.length; i++) {
                            $('#knowledgeArea')
                            .append($("<option></option>")
                            .attr("value",knowledgeAreaIds[i])
                            .text(knowledgeAreaNames[i]));

                        }


                        for (var i = 0; i < subKnowledgeAreaIds.length; i++) {

                            $('#subKnowledgeArea')
                            .append($("<option></option>")
                            .attr("value",subKnowledgeAreaIds[i])
                            .text(subKnowledgeAreaNames[i])); 
                        }

                        for (var i = 0; i < subjectIds.length; i++) {
                            $('#subject')
                            .append($("<option></option>")
                            .attr("value",subjectIds[i])
                            .text(subjectNames[i])); 
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





