 $(document).ready(function() { 
    $('.date').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        startView: 3
    });
    $('.date').on('keydown',function(e){
        e.preventDefault();
    });
    $('.date-notificar').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
    });
    $('.date-notificar').on('keydown',function(e){
        e.preventDefault();
    });

});