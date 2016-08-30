$(document).ready(function(){

    var infoCar = function(){
        var vehicleId = {id: $('#vehicle-id').val()};
        var url = webroot + 'vehicles/getVehicleInformation';
        var refresh = '<i class="fa fa-refresh fa-spin"></i>';

        $('#plate h5').html(refresh);
        $('#model h5').html(refresh);
        $('#renavam h5').html(refresh);
        $.post(url,vehicleId, function(event){
            if(event.result.type === 'success'){
                var vehicle = event.result.data;

                $('#plate h5').text(vehicle.plate);
                $('#model h5').text(vehicle.model);
                $('#renavam h5').text(vehicle.renavam);
            }
        },'json');
    };

    if($('#vehicle-id').val().length > 0){
        infoCar();
    }
    $(document).on('change','#vehicle-id', infoCar);

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