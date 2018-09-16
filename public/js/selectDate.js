$(document).ready(function() 
{
	// **********************
	// DOMICILIAR PAGO
	// **********************
	$("#edit-si").prop('checked',true);


	$(".edit-date").change(function(e){

		var formaPago = this.value;
		
		if(formaPago == "si"){
			$('div.dates').slideDown('250');
		}

		if(formaPago == "no"){
			$('div.dates').slideUp('250');
		}

	});
});