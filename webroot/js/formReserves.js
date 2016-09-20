$(document).ready(function() {
    $('#date-start, #date-end').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false
    });
    
    $('#disp').click(function(){
        if($('#date-start').val() != '' && $('#date-end').val() != ''){
            
        }
    });
});