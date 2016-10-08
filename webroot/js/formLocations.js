$(document).ready(function(){
    $('#client-id, #vehicle-id').select2();

    $('input[type="radio"]').iCheck({
        radioClass: 'iradio_square-blue'
    });

    $('#carregar').attr('disabled', true);
    $('#reserves').modal('show');

    $('input[type="radio"]').on('ifChecked', function(){
        $('#carregar').attr('disabled', false);
    });

    var vehicleInformations = function(id){
        var url = webroot + 'vehicles/get-vehicle-information';
        var data = {
            id: id
        };
        $.post(url, data, function(json){
            console.log(json);
            if(json.result.type == 'success'){
                $('.vehicle-reserve').text(json.result.data.model + ' (' + json.result.data.plate + ')');
            }
        },'json');
    };

    var infoCar = function(){
        var divVehicle = $('figure img');
        var span = $('figure span');
        var figure = $('figure');

        figure.css('transition', '1s').css('opacity', '0.1');

        var vehicleId = {
            id: $('#vehicle-id-hidden').val()
        };
        var url = webroot + 'vehicles/getVehicleInformation';
        var refresh = '<i class="fa fa-refresh fa-spin"></i>';

        $.post(url,vehicleId, function(event){
            if(event.result.type === 'success'){
                var vehicle = event.result.data;
                divVehicle.attr('src', (webroot + vehicle.picture).replace('//', '/'));
                span.html('<h3>' + 'R$ ' + vehicle.day_price + ' <small>(diária)</small></h3>');
                $('#img').fadeIn('fast');
                $('figure span').show();
                figure.css('transition', '1s').css('opacity', '1');

                /* Calculando TOTAL */
                var date_start = moment($('#out-date').val(), 'DD/MM/YYYY');
                var date_end = moment($('#return-date').val(), 'DD/MM/YYYY');
                var diff  = date_end.diff(date_start, 'days');

                var total = ('R$ ' + (diff * parseFloat(vehicle.day_price.replace(',','.'))).toFixed(2));
                $('.total').html('<small class="min-small">' + (diff == 1 ? diff + ' dia' : diff + ' dias') + ' x ' + vehicle.day_price  + '</small>' + total.replace('.',','));
                $('#total').val(total.replace('R$ ',''));
            }
        },'json');
    };

    var infoClient = function(){
        var clientId = {
            id: $('#client-id').val()
        };
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

    $(document).on('click', '.btn-visualizacao', function(e){
        e.preventDefault();
        $('#modal-image').modal('show');
        $('#imagem-modal').attr('src', $('figure img').attr('src'));
    });
    $(document).on('change', '#client-id', infoClient);
    $(document).on('click', '#carregar', function(){
        var infos = ['out-date','return-date','remove_schedule','devolution_schedule','client-id'];
        $.each(infos, function(k,v){
            $('#' + v).prop('readonly', true);
        });
        $('#client-id').attr('disabled', true);

        $('.modal-footer > button').attr('disabled', true);
        $('.modal-footer > span').show();
        var reserve = $('input[name="reserve"]:checked').val();
        var url = webroot + 'reserves/getInformations';
        var data = {
            id: reserve
        };

        $.post(url, data, function(e){
            if(e.result.status === 'success'){
                var event = e.result.data;

                $('#out-date').val(event.date_start);
                $('#return-date').val(event.date_end);
                $('#remove_schedule').val(event.remove_schedule);
                $('#devolution_schedule').val(event.devolution_schedule);
                $('#select2-client-id-container').text(event.client_name);
                $('#client-id').val(event.client_id);
                infoClient();
                $('#vehicle-id-hidden').val(event.vehicle_id);
                infoCar();
                vehicleInformations(event.vehicle_id);
                $('.vehicle-input').fadeOut('fast');
                $('#reserves').modal('hide');
            }
        },'json');
    });
});