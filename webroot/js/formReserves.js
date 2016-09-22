$(document).ready(function() {
    $('#client-id').select2();
    $('#vehicle-id').select2();

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
        var date_start = $('#date-start').val();
        var date_end = $('#date-end').val();
        var remove_schedule = $('#remove_schedule').val();
        var devolution_schedule = $('#devolution_schedule').val();

        if(date_start != '' && date_end != '' && remove_schedule != '' && devolution_schedule != ''){
            $('.clients, .vehicles').fadeIn('fast');
            $('p').remove();
            var formData = {
                date_start: date_start,
                date_end: date_end,
                remove_schedule: remove_schedule,
                devolution_schedule: devolution_schedule
            };
            populateVehicles(formData);
        } else {
            $('p').remove();
            var ban = '<i class="fa fa-exclamation-circle"></i>';
            $(this).after('<p>'+ ban +'Preencha todas as informações</p>');
        }
    });

    var populateVehicles = function(formData){
        var url = webroot + 'reserves/get-vehicles-by-date-and-schedule';
        $.post(url, formData, function(e){
            var options = "";
             $('#select2-vehicle-id-container').text('buscando veículo...');
            if(e.result.type === 'success'){
                $.each(e.result.data, function(key, value){
                    options += "<option value=" + value.id + ">" + value.model + "</option>";
                });
                $('#select2-vehicle-id-container').text('Selecione o Veículo');
                $("#vehicle-id").html(null);
                $("#vehicle-id").html(options);
            }
        },'json');
    };

    var infoCar = function(){
        var vehicleId = {id: $('#vehicle-id').val()};
        var url = webroot + 'vehicles/getVehicleInformation';
        var refresh = '<i class="fa fa-refresh fa-spin"></i>';

        $('#plate h5').html(refresh);
        $('#renavam h5').html(refresh);
        $.post(url,vehicleId, function(event){
            if(event.result.type === 'success'){
                var vehicle = event.result.data;

                $('#plate h5').text(vehicle.plate);
                $('#renavam h5').text(vehicle.renavam);
            }
        },'json');
    };

    var infoClient = function(){
        var clientId = {id: $('#client-id').val()};
        var url = webroot + 'clients/getClientInformation';
        var refresh = '<i class="fa fa-refresh fa-spin"></i>';

        $('#cnh h5').html(refresh);
        $('#cpf h5').html(refresh);
        $('#city h5').html(refresh);
        $.post(url,clientId, function(event){
            if(event.result.type === 'success'){
                var client = event.result.data;

                $('#cnh h5').text(client.cnh);
                $('#cpf h5').text(client.cpf);
                $('#city h5').text(client.city_name + '/' + client.state_name);
            }
        },'json');
    };

    $(document).on('change', '#client-id', infoClient);
    $(document).on('change', '#vehicle-id', infoCar);
});