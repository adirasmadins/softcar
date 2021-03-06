$(document).ready(function(){
    $('#service-type, #vehicle-id').select2();

    if($('#value-description').val().length){
        $('#description').val($('#value-description').val());
    }

    var changeServiceType = function(){
        if($('#service-type').val() == 'o'){
            $('.make-km').val('').attr('disabled', true).hide();
            $('.description').attr('disabled', false).show();
        } else {
            $('.make-km').attr('disabled', false).show();
            $('.description').val('').attr('disabled', true).hide();
        }
    };

    if($('#service-type').val().length > 0){
        changeServiceType();
    }
    $(document).on('change', '#service-type', changeServiceType);

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

    $('#make-km, #make-date').keyup(function (){
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $('#formServices').validate({
        rules: {
            vehicle_id: {
                required: true
            },
            service_type: {
                required: true
            },
            make_km: {
                required: true
            },
            make_date: {
                required: true
            },
            value: {
                required: true
            },
            description: {
                required: true
            }
        },
        errorPlacement: function(error,element) {
            return true;
        }
    });
    
    var formServices = new Form();
    formServices.inputMasks({
        '#make-date': 'date'
    });
});