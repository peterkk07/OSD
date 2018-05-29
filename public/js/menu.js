$(document).ready(function() {
	$(".opener-menu").click(function() {
		openMenu();
	});
	$(".closer-menu").click(function() {
		closeMenu();
	});

	// boton limpiar en login y registro
	$("body").on("click",".btn-clean",function(e){
		e.preventDefault();
		$("#cedula").val("");
		$("#password").val("");
		$("#type_user").val("");
		$("#ci").val("");
		$("#name").val("");
		$("#surname").val("");
		$("#password").val("");
		$("#password-confirm").val("");
		$("#email").val("");
	});
});

$(document).keyup(function(e) {
	if($(".block-menu").is(":visible") && e.keyCode === 27){
		closeMenu();
	}
});

$(window).resize(function(){
	if($(".menu-complete").hasClass("open")){
		adjustMenu();	
	}
});


/*------------------------
- Functions
------------------------*/

function openMenu(){
	var wWin = $(window).width();
	var wMenu = $(".menu-complete").outerWidth();
	
	$(".block-menu").fadeIn("fast", function() {
		$(".menu-complete").animate({
			left: (wWin-wMenu)+"px"
		},
		500,
		function(){
			$(".menu-complete").addClass("open");	
		});
	});
}

function closeMenu() {
	$(".menu-complete").animate({
		left: "150%"
		},
		500,
		function() {
			$(".menu-complete").removeClass("open");
			$(".block-menu").fadeOut("fast");
		}
	);
}

function adjustMenu(){
	var wWin = $(window).width();
	var wMenu = $(".menu-complete").outerWidth();
	
	$(".menu-complete").css({
		left: (wWin-wMenu)+"px"
	});
}