$(document).ready(function() 
{

   

/*Mostrar graficos y actualizarlos*/
 $("#select").click(function(){

        var myPromise = new Promise(function (resolve, reject) {

        var semester = $('select[name=semester]').val();
        var _token = $('input[name="_token"]').val();
        var subject = $('select[name=subject]').val();
        var question = $('select[name=question]').val();
        var teacher_id = $('input[name="teacher_id"]').val();
        var section = $('select[name="section"]').val();
        var response;

        $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: 'get_chart_teacher', // This is the url we gave in the route
                data: {'section' : section, 'teacher_id' : teacher_id, 'question':question, 'semester' : semester, '_token' : _token, 
                'subject' : subject }, // a JSON object to send back
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


            var CountStudentsAnswered = result.CountStudentsAnswered;
           
            var CountStudentPercentage = result.CountStudentPercentage;
                                    

            $('#count-content').remove(); // 

            $('#count-container').append('<div id="count-content"> Cantidad de estudiantes encuestados: '+CountStudentsAnswered+'('+CountStudentPercentage+')</div>'); //


            /* EN CASO DE QUE SEA  LA EVALUACIÓN GLOBAL*/

            if ( result.type_request == "global" ) {

                var subjectName = result["SubjectName"];


               /* tables */
                $('.table-container1').remove();
                $('.table-container2').remove();
                $('.table-container3').remove();

               $( '<div class="table-container1"> </div>' ).insertAfter( $( "#label1" ) );
               $( '<div class="table-container2"> </div>' ).insertAfter( $( "#label2" ) );
               $( '<div class="table-container3"> </div>' ).insertAfter( $( "#label3" ) );

               /*end tables*/

                $('#myChart').remove(); // this is my <canvas> element

                $('#question-content').remove(); // 

                $('#question-container').append('<div id="question-content"> </div>'); //
                
                if(subjectName == "global-subject") {

                    $('#question-content').append('<p> Evaluación global de los profesores para todas las materias</p>'); 
                }
                else {

                    $('#question-content').append('<p> Evaluación global de los profesores para la materia: "'+subjectName+'"</p>'); 
                }



                $('#graph-container').append('<canvas id="myChart"><canvas>');

                var canvas = document.getElementById('myChart');
                
                var data = {

                labels: result["labels"],
                    
                    datasets: [ {
                      type: 'bar',
                      label: 'Completamente en desacuerdo',
                      backgroundColor: "rgba(195,59,59,0.85)",
                      data: result["option1"]
                    }, {
                      type: 'bar',
                      label: 'En desacuerdo',
                      backgroundColor: "rgba(255,157,56,1)",
                      data: result["option2"]
                    },{
                      type: 'bar',
                      label: 'Ni de acuerdo ni en desacuerdo',
                      backgroundColor: "rgba(255,221,56,1)",
                      data: result["option3"]
                    },{
                      type: 'bar',
                      label: 'De acuerdo',
                      backgroundColor:"rgba(64,167,66,1)",
                      data: result["option4"]
                    },{
                      type: 'bar',
                      label: 'Completamente de acuerdo',
                      backgroundColor: "rgba(51,122,183,1)",
                      data: result["option5"]
                    }


                    ]
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


            /**********************************************************/

            function Table() {
                    //sets attributes
                    this.header = [];
                    this.data = [[]];
                    this.tableClass = ''
                }

                Table.prototype.setHeader = function(keys) {
                    //sets header data
                    this.header = keys
                    return this
                }

                Table.prototype.setData = function(data) {
                    //sets the main data
                    this.data = data
                    return this
                }

                Table.prototype.setTableClass = function(tableClass) {
                    //sets the table class name
                    this.tableClass = tableClass
                    return this
                }


            
                Table.prototype.build1 = function(container) {

                    //default selector

                    container = container || '.table-container1'
                 
                    //creates table
                    var table = $('<table></table>').addClass(this.tableClass)

                    var tr = $('<tr></tr>') //creates row
                    var th = $('<th></th>') //creates table header cells
                    var td = $('<td></td>') //creates table cells

                    var header = tr.clone() //creates header row

                    //fills header row
                    this.header.forEach(function(d) {
                        header.append(th.clone().text(d))
                    })

                    //attaches header row
                    table.append($('<thead></thead>').append(header))
                    
                    //creates 
                    var tbody = $('<tbody></tbody>')

                    //fills out the table body
                    this.data.forEach(function(d) {
                        var row = tr.clone() //creates a row
                        d.forEach(function(e,j) {
                            row.append(td.clone().text(e)) //fills in the row
                        })
                        tbody.append(row) //puts row on the tbody
                    })
                 
                    $(container).append(table.append(tbody)) //puts entire table in the container

                    return this
                }



                Table.prototype.build2 = function(container) {
                    
                
                    //default selector
                    container = container || '.table-container2'
                 
                    //creates table
                    var table = $('<table></table>').addClass(this.tableClass)

                    var tr = $('<tr></tr>') //creates row
                    var th = $('<th></th>') //creates table header cells
                    var td = $('<td></td>') //creates table cells

                    var header = tr.clone() //creates header row

                    //fills header row
                    this.header.forEach(function(d) {
                        header.append(th.clone().text(d))
                    })

                    //attaches header row
                    table.append($('<thead></thead>').append(header))
                    
                    //creates 
                    var tbody = $('<tbody></tbody>')

                    //fills out the table body
                    this.data.forEach(function(d) {
                        var row = tr.clone() //creates a row
                        d.forEach(function(e,j) {
                            row.append(td.clone().text(e)) //fills in the row
                        })
                        tbody.append(row) //puts row on the tbody
                    })
                 
                    $(container).append(table.append(tbody)) //puts entire table in the container

                    return this
                }


                Table.prototype.build3 = function(container) {

                    //default selector
                    container = container || '.table-container3'
                 
                    //creates table
                    var table = $('<table></table>').addClass(this.tableClass)

                    var tr = $('<tr></tr>') //creates row
                    var th = $('<th></th>') //creates table header cells
                    var td = $('<td></td>') //creates table cells

                    var header = tr.clone() //creates header row

                    //fills header row
                    this.header.forEach(function(d) {
                        header.append(th.clone().text(d))
                    })

                    //attaches header row
                    table.append($('<thead></thead>').append(header))
                    
                    //creates 
                    var tbody = $('<tbody></tbody>')

                    //fills out the table body
                    this.data.forEach(function(d) {
                        var row = tr.clone() //creates a row
                        d.forEach(function(e,j) {
                            row.append(td.clone().text(e)) //fills in the row
                        })
                        tbody.append(row) //puts row on the tbody
                    })
                 
                    $(container).append(table.append(tbody)) //puts entire table in the container

                    return this
                }


             /*preguntas*/
                var data1 = {
                    k: ['Número de pregunta'],
                    v: result["questionsTable"]
                }

               /* opciones cantidad */
                var data2 = {
                    k: ['Completamente en desacuerdo', 'En desacuerdo', 'Ni de acuerdo ni en desacuerdo', 'De acuerdo', 'Completamente de acuerdo'],
                    v: result["items"]
                }

               
               /* opciones porcentaje */

               var data3 = {
                    k: ['Completamente en desacuerdo', 'En desacuerdo', 'Ni de acuerdo ni en desacuerdo', 'De acuerdo', 'Completamente de acuerdo'],
                    v: result["itemspocentaje"]
                }


                //creates new table object

                var table1 = new Table()

                var table2 = new Table()

                var table3 = new Table()
                    
               
                //sets table data and builds it

                $(".label-table").css("display","block");  

                 table1
                    .setHeader(data1.k)
                    .setData(data1.v)

                    .setTableClass('table table-bordered')
                    .build1()


                table2
                    .setHeader(data2.k)
                    .setData(data2.v)

                    .setTableClass('table table-bordered')
                    .build2()

                table3
                    .setHeader(data3.k)
                    .setData(data3.v)

                    .setTableClass('table table-bordered')
                    .build3()   
        }

         /* END  EN CASO DE QUE SEA  LA EVALUACIÓN GLOBAL*/


         /* EN  CASO DE QUE SEA  LA EVALUACIÓN DE UNA PREGUNTA ESPECÍFICA : */

            var question = result["question"];

            if ( result.type_request == "specific" ) {

                $(".label-table").css("display","none"); 

                $('.table-container1').remove();
                $('.table-container2').remove();
                $('.table-container3').remove();
                

                $('#myChart').remove(); // this is my <canvas> element

                $('#question-content').remove(); // 

                $('#question-container').append('<div id="question-content"> </div>'); //
                
                $('#question-content').append('<p>'+question+'</p>'); //

                $('#graph-container').append('<canvas id="myChart"><canvas>');

                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Completamente de en desacuerdo", "En desacuerdo", "Ni de acuerdo ni en desacuerdo", "De acuerdo", "Completamente de acuerdo"],
                        datasets: [{
                            
                            data: result["items"],
                            backgroundColor: [
                                'rgba(195,59,59,0.85)',
                                'rgba(255,157,56,1)',
                                'rgba(255,221,56,1)',
                                'rgba(64,167,66,1)',
                                'rgba(51,122,183,1)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {

                        legend: {
                            display: false,
                        },
                         tooltips: {
                            callbacks: {
                                label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`, 
                                title: () => null,
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

            }   


         /**********************************************************/

        }, function (result) {
            // Prints "Aww didn't work" or
            // "Page loaded, but status not OK."
            console.error(result); 
             
                $("#error-chart").fadeIn().delay(10000).fadeOut();

        });



    });


    /*Filtrar Opciones de búsqueda*/

  
        /*Actualizar preguntas segun semestre de la encuesta*/

        $("#semester").change(function(e){
            
            var semester = this.value;

            $('#question').empty();
            $('#subject').empty();
            $('#section').empty();
         
            var _token = $('input[name="_token"]').val();

            var teacher_id = $('input[name="teacher_id"]').val();
           
                $.ajax({
                    method: 'POST', // Type of response and matches what we said in the route
                    url: 'update_teacher_options', // This is the url we gave in the route
                    data: {'teacher_id' : teacher_id,'semester' : semester, '_token' : _token}, // a JSON object to send back
                   
                    success: function(response) { // What to do if we succeed
                       
                        var questionNames = response.questionNames;
                        var questionId = response.questionId;
                        var subjectIds = response.subjectIds;
                        var subjectNames = response.subjectNames;
                        var sectionIds = response.sectionIds;
                        var sectionNames = response.sectionNames;
                        

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


                        $('#subject')
                            .append($("<option></option>")
                            .attr("value","")
                            .text("Seleccione.."));

                        $('#subject')
                        .append($("<option></option>")
                        .attr("value","global-subject")
                        .text("Evaluación de todas las materias"));


                        for (var i = 0; i < subjectIds.length; i++) {
                            $('#subject')
                            .append($("<option></option>")
                            .attr("value",subjectIds[i])
                            .text(subjectNames[i]));

                        }

                        $('#section')
                            .append($("<option></option>")
                            .attr("value","")
                            .text("Seleccione.."));

                   /*     $('#section')
                        .append($("<option></option>")
                        .attr("value","global-section")
                        .text("Evaluación de todas las secciones"));*/


                        for (var i = 0; i < sectionIds.length; i++) {
                            $('#section')
                            .append($("<option></option>")
                            .attr("value",sectionIds[i])
                            .text(sectionNames[i]));

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

               if(subject == "global-subject"){

                    $('#section').prop('disabled', 'true');  

               } 

               else{

                   $("#section").removeAttr('disabled');
               } 

               
                
               /* var semesterId = $('select[name=semester]').val();
            

                $("div#selectionArea select#knowledgeArea option").each(function(){          
                    
                    $(this).attr("selected",false);  
                    $(this).prop("selected",false);             
                 });  

                $("div#selectionSubArea select#subKnowledgeArea option").each(function(){      
                    
                    $(this).attr("selected",false); 
                    $(this).prop("selected",false);           
                }); */

               
        });






});





