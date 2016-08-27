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
        minViewMode: "years"
    })

    $('#ipva-expiration').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $('#depvat-expiration').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $('#licensing-expiration').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $("#ipva-value").maskMoney({
        prefix:'R$ ',
        allowNegative: true,
        thousands:',',
        decimal:'.',
        affixesStay: false
    });

    $("#depvat-value").maskMoney({
        prefix:'R$ ',
        allowNegative: true,
        thousands:'.',
        decimal:',',
        affixesStay: false
    });

    $("#licensing-value").maskMoney({
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
});