$(document).ready(function() 
{

/*Mostrar graficos y actualizarlos*/
 $("#select").click(function(){

        var myPromise = new Promise(function (resolve, reject) {

        var semester = $('select[name=semester]').val();
        var _token = $('input[name="_token"]').val();
        var knowledgeArea = $('select[name=knowledgeArea]').val();
        var subject = $('select[name=subject]').val();
        var teacher = $('select[name=teacher]').val();

        var response;

        $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: 'get_chart', // This is the url we gave in the route
                data: {'semester' : semester, '_token' : _token, 
                'knowledgeArea' : knowledgeArea, 'subject' : subject, 'teacher' : teacher }, // a JSON object to send back
                success: function(response) { // What to do if we succeed

                    resolve(response["options"]);
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

             $('#myChart').remove(); // this is my <canvas> element
             
             $('#graph-container').append('<canvas id="myChart"><canvas>');

            var canvas = document.getElementById('myChart');
            
            var data = {

            labels: ["Opción 1", "Opción 2", "Opción 3", 
                    "Opción 4","Opción 5"],
            
            datasets: [{
                    label: 'Catidad por opción',
                    data: result,
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

        }, function (result) {
            // Prints "Aww didn't work" or
            // "Page loaded, but status not OK."
            console.error(result); 
        });



    });


 /* */

/**/
    /*Filtrar Opciones de búsqueda*/

    /*Por area de conocimiento*/
    $("#knowledgeArea").change(function(e){
        
        var knowledgeArea = this.value;

        $('#subKnowledgeArea').empty();
        $('#subject').empty();
        $('#teacher').empty();
        
        
        var _token = $('input[name="_token"]').val();
       
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: 'update_knowledgeArea', // This is the url we gave in the route
                data: {'knowledgeArea' : knowledgeArea, '_token' : _token}, // a JSON object to send back
               
                success: function(response) { // What to do if we succeed

                    var subKnowledgeAreas = response.subKnowledgeAreas;
                    var subKnowledgeAreaIds = response.SubKnowledgeAreaIds;
                    var subjectNames = response.subjectNames;
                    var subjectsIds = response.subjectsIds;
                    var teachersNames = response.teachersNames;
                    var teachersIds = response.teachersIds;


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
                

                },

                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                
                    console.log('Page loaded, but status not OK.');
                }
            });
       
        });

         /*Por sub area de conocimiento*/
        $("#subKnowledgeArea").change(function(e){
            
            var SubKnowledgeArea = this.value;

            $('#subject').empty();
            $('#teacher').empty();
            
            
            var _token = $('input[name="_token"]').val();
           
                $.ajax({
                    method: 'POST', // Type of response and matches what we said in the route
                    url: 'update_subKnowledgeArea', // This is the url we gave in the route
                    data: {'SubKnowledgeArea' : SubKnowledgeArea, '_token' : _token}, // a JSON object to send back
                   
                    success: function(response) { // What to do if we succeed
                       
                        var subjectNames = response.subjectNames;
                        var subjectsIds = response.subjectsIds;
                        var teachersNames = response.teachersNames;
                        var teachersIds = response.teachersIds;


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
                        data: {'Subject' : Subject, '_token' : _token}, // a JSON object to send back
                   
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
                    

                    },

                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    
                        console.log('Page loaded, but status not OK.');
                    }
                });
           
            });




});





