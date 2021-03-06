$(document).ready(function(){
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

    $("#total").maskMoney({
        prefix: '',
        allowNegative: true,
        thousands:'.',
        decimal:',',
        affixesStay: true
    });

    $('#client-id, #vehicle-id, #driver-id, #form-payment').select2();

    $('input[type="radio"]').iCheck({
        radioClass: 'iradio_square-blue'
    });

    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'iradio_square-blue'
    });

    $('#carregar').attr('disabled', true);
    if($('#id-location').val() == ''){
        $('#reserves').modal('show');
    } else {
        infoClient();
        var veri = $('#tank_check_').val();
        $('#tank_check').text(veri);
        if($('#free_km').is(':checked')){
            $('#allowed_km').val('');
            $('#allowed_km').attr('disabled', true);
        }
    }

    $('input[type="radio"]').on('ifChecked', function(){
        $('#carregar').attr('disabled', false);
    });

    var acresDesc = function(e){
        e.preventDefault();
        var div = $('.acrescimo-desconto');

        if(div.is(':visible')){
            div.hide(100);
        } else {
            div.show(100);
        }
    };

    var calcular = function(e){
        e.preventDefault();
        $('.acrescimo-desconto').hide(100);
        var valor = $('#valor').val();

        if(valor != ''){
            var total = $('.total').text().replace('R$ ','');
            var totalNew = (parseFloat(total.replace('.',',')) + (parseFloat(valor)));
            $('#total').val(currencyFormat(totalNew));
        }
    };

    function currencyFormat (num) {
        return num.toFixed(2).replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    var vehicleInformations = function(id){
        var url = webroot + 'vehicles/get-vehicle-information';

        var data = {
          id: id
        };

        $.post(url, data, function(json){
            if(json.result.type == 'success'){
                $('.km-inicial span').text(json.result.data.last_km);
                $('.km_inicial').val(json.result.data.last_km);
            }
        },'json');
    };

    var infoCar = function(){
        var divVehicle = $('figure img');
        var span = $('figure span');
        var figure = $('figure');

        figure.css('transition', '1s').css('opacity', '0.1');

        var vehicleId = {
            id: $('#vehicle-id-hidden').val() || $('#vehicle-id').val()
        };
        var url = webroot + 'vehicles/getVehicleInformation';
        var refresh = '<i class="fa fa-refresh fa-spin"></i>';

        $.post(url,vehicleId, function(event){
            if(event.result.type === 'success'){
                var vehicle = event.result.data;
                vehicleInformations(vehicle.id);
                divVehicle.attr('src', (webroot + vehicle.picture).replace('//', '/'));
                span.html('<h3>' + 'R$ ' + vehicle.day_price + ' <small>(diária)</small></h3>');
                $('#img').fadeIn('fast');
                $('figure span').show();
                figure.css('transition', '1s').css('opacity', '1');

                /* Calculando TOTAL */
                var outD = $('.out-date').val() || $('#out-date').val();
                var returnD = $('.return-date').val() || $('#return-date').val();
                var date_start = moment(outD, 'DD/MM/YYYY');
                var date_end = moment(returnD, 'DD/MM/YYYY');
                var diff  = date_end.diff(date_start, 'days');

                var total = ('R$ ' + (diff * parseFloat(vehicle.day_price.replace(',','.'))).toFixed(2));
                $('.total').html('<small class="min-small hidden-xs">' + (diff == 1 ? diff + ' dia' : diff + ' dias') + ' x ' + vehicle.day_price  + '</small>' + total.replace('.',','));

                total = total.replace('.',',')

                $('#total').val(total.replace('R$ ',''));
                $('.btn-visualizacao').show();
            }
        },'json');
    };

    var updateReserveStatus = function(id){
        var url = webroot + 'reserves/update-status';
        var data = {
            id: id
        };

        $.post(url, data, function(e){
            if(e.result.type != 'success'){
                console.log('ERRO AO MUDAR STATUS DA RESERVA');
            }
        },'json');
    };

    $(document).on('click', '.btn-calcular', calcular);
    $(document).on('click', '.acres-desc', acresDesc);
    $(document).on('click', '.btn-visualizacao', function(e){
        e.preventDefault();

        $('#imagem-modal').attr('src', $('figure img').attr('src'));

        var url = webroot + 'vehicles/get-vehicle-information';

        var data = {
          id: $('#vehicle-id-hidden').val() || $('#vehicle-id').val()
        };

        $.post(url, data, function(json){
            if(json.result.type == 'success'){
                var vehicle = json.result.data;
                $('#modal-image tbody td:nth-child(1)').text(vehicle.model);
                $('#modal-image tbody td:nth-child(2)').text(vehicle.plate);
                $('#modal-image tbody td:nth-child(3)').text(vehicle.mark);
                $('#modal-image tbody td:nth-child(4)').text(vehicle.type_name);
                $('#modal-image tbody td:nth-child(5)').text(vehicle.day_price);
                $('#modal-image tbody td:nth-child(6)').text(vehicle.fuel_name);
                $('#modal-image tbody td:nth-child(7)').text(vehicle.color);
            }
        },'json');
        $('#modal-image').modal('show');
    });

    $(document).on('change', '#client-id', infoClient);
    $(document).on('click', '#carregar', function(){
        var infos = ['out-date','return-date','remove_schedule','devolution_schedule','client-id'];
        $.each(infos, function(k,v){
            $('#' + v).prop('readonly', true);
        });
        $('#client-id').attr('disabled', true);
        $('.sub-img').show();
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
                $('#client_id_hidden').val(event.client_id);

                $('#start_value').val(event.total);
                infoClient();
                $('#vehicle-id-hidden').val(event.vehicle_id);
                infoCar();
                $('#car-name-modal').text();
                // vehicleInformations(event.vehicle_id);
                $('#vehicle-id').val(event.vehicle_id);
                $('.vehicle-input').fadeOut('fast');
                $('#reserves').modal('hide');
                $('.btn-visualizacao').show();
            }
        },'json');
    });

    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false
    });

    $('#out-date').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $(document).on('change', '#vehicle-id', infoCar);

    var verifyDisponibility = function (outDate, returnDate){
      var options = "";

      var data = {
        date_start: outDate,
        date_end: returnDate
      };
      var url = webroot + 'reserves/get-vehicles-by-date-and-schedule';

      $.post(url, data, function(e){
        if(e.result.type === 'success'){
            var selected = 'selected="selected"';
            $.each(e.result.data, function(key, value){
                if(value.id == $('#vehicle-id-hidden').val()){
                    $('#select2-vehicle-id-container').text(value.model);
                    options += "<option value=" + value.id + " selected>" + value.model + "</option>";
                } else {
                    options += "<option value=" + value.id + ">" + value.model + "</option>";
                }
            });

            $("#vehicle-id").html(null);
            $("#vehicle-id").html(options);
            $('#vehicle-id').attr('disabled', false);
        }
      },'json');
    }

    $(document).on('change', '#out-date', function(e){
      if($('#out-date').val() != ''){
        if($('#return-date').val() != ''){
          verifyDisponibility($('#out-date').val(), $('#return-date').val());
        }
      }
    });

    $(document).on('change', '#return-date', function(e){
      if($('#out-date').val() != ''){
        if($('#return-date').val() != ''){
          verifyDisponibility($('#out-date').val(), $('#return-date').val());
        }
      }
    });

    $('#return-date').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $('#allowed_km').keyup(function(){
        if($(this).val()){
            var val = parseFloat($('.km-inicial span').text()) + parseFloat($(this).val());
            $('.km-final span').text(val);
            $('.km_final').val(val);
        } else {
            $('.km-final span').text($('.km-inicial span').text());
        }
    });

    $("#allowed_km").on("keypress keyup blur",function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('#free_km').on('ifChecked', function(){
        $('#allowed_km').val('').attr('disabled', true);
        $('.km-final span').text(' ILIMITADO');
    });

    $('#free_km').on('ifUnchecked', function(){
        $('#allowed_km').attr('disabled', false);
        $('.km-final span').empty();
    });

    $(document).on('submit', function(e){
        updateReserveStatus($('input[name="reserve"]:checked').val());
    });

    $('#formLocations').validate({
        rules: {
            out_date: {
                required: true
            },
            return_date: {
                required: true
            },
            client_id: {
                required: true
            },
            tank_check: {
                required: true
            },
            vehicle_id: {
                required: true
            },
            total: {
                required: true
            },
            form_payment: {
                required: true
            }
        },
        errorPlacement: function(error,element) {
            return true;
        }
    });
});
