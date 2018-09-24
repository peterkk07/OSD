$(document).ready(function() 
{

   


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





