$(document).ready(function() 
{
	// **********************
	// Mostrar  grafica
	// **********************
 	$("#select").click(function(){

 		var semester = $('select[name=selector]').val();
		var _token = $('input[name="_token"]').val();
		var knowledgeArea = $('select[name=knowledgeArea]').val();
		var subject = $('select[name=subject]').val();
		var teacher = $('select[name=teacher]').val();

        $.ajax({
			method: 'POST', // Type of response and matches what we said in the route
			url: 'get_chart', // This is the url we gave in the route
			data: {'semester' : semester, '_token' : _token, 
			'knowledgeArea' : knowledgeArea, 'subject' : subject, 'teacher' : teacher }, // a JSON object to send back
			success: function(response) { // What to do if we succeed


				console.log(response["options"]);

								
			},
			error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
				console.log(JSON.stringify(jqXHR));
				console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			}
		});

    });

});