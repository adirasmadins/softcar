$(document).ready(function(){
    $('#service-type').select2();
    $('#vehicle-id').select2();

    $('#service-type').change(function(){
        if($(this).val() == 'o'){
            $('.make-km').attr('disabled', true).hide();
            $('.description').attr('disabled', false).show();
        } else {
            $('.make-km').attr('disabled', false).show();
            $('.description').attr('disabled', true).hide();
        }
    });

    $('#make-date').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $("#value").maskMoney({
        prefix:'R$ ',
        allowNegative: true,
        thousands:'.',
        decimal:',',
        affixesStay: false
    });
});