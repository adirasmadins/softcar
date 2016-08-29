$(document).ready(function(){

    if($('#vehicle-id').val().length >= 1){
        var vehicleId = {id: $('#vehicle-id').val()};
        var url = webroot + 'vehicles/getVehicleInformation';

        $.post(url,vehicleId, function(event){
            if(event.result.type === 'success'){
                var vehicle = event.result.data;

                $('#plate h4').text(vehicle.plate);
                $('#model h4').text(vehicle.model);
                $('#renavam h4').text(vehicle.renavam);
            }
        },'json');
    }

    $('#vehicle-id').select2();

    $('#referent-year').datepicker({
        language: "pt-BR",
        format: 'yyyy',
        minViewMode: "years",
        autoclose: true
    });

    $('#depvat-expiration, #licensing-expiration, #ipva-expiration').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $("#ipva-value, #depvat-value, #licensing-value").maskMoney({
        prefix:'R$ ',
        allowNegative: true,
        thousands:',',
        decimal:'.',
        affixesStay: false
    });

    $('#vehicle-id').change(function(){
        var vehicleId = {id: $(this).val()};
        var url = webroot + 'vehicles/getVehicleInformation';
        var refresh = '<i class="fa fa-refresh fa-spin"></i>';

        $('#plate h4').html(refresh);
        $('#model h4').html(refresh);
        $('#renavam h4').html(refresh);
        $.post(url,vehicleId, function(event){
            if(event.result.type === 'success'){
                var vehicle = event.result.data;

                $('#plate h4').text(vehicle.plate);
                $('#model h4').text(vehicle.model);
                $('#renavam h4').text(vehicle.renavam);
            }
        },'json');
    });

    $('#formRates').validate({
        rules: {
            referent_year: {
                required: true
            },
            ipva_expiration: {
                required: true
            },
            depvat_expiration: {
                required: true
            },
            licensing_expiration: {
                required: true
            },
            ipva_value: {
                required: true
            },
            depvat_value: {
                required: true
            },
            licensing_value: {
                required: true
            },
            vehicle_id: {
                required: true
            }
        },
        errorPlacement: function(error,element) {
            return true;
        }
    });
});