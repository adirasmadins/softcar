$(document).ready(function(){
    $('.km-chegada').keyup(function(){
      var val = $(this).val();
      if(val){
        if($('.td2').text() != 'LIVRE'){
            $('.span-status').remove();

            if(parseFloat(val) > parseFloat($('.td3').text())){
                $('.km-chegada').after('<span class="label label-warning span-status"><i class="fa fa-exclamation-circle"></i> Fora do permitido - passaram ' + (parseFloat($(this).val())-parseFloat($('.td3').text())) + 'km</span>');
                $('.confirm-location').attr('disabled', false);
            } else if(parseFloat(val) < parseFloat($('.td1').text())){
              $('.km-chegada').after('<span class="label label-danger span-status"><i class="fa fa-times"></i> Quilometragem de devolução é menor</span>');
              $('.confirm-location').attr('disabled', true);
            } else if((parseFloat(val) >= parseFloat($('.td1').text())) && (parseFloat(val) <= parseFloat($('.td3').text()))){
              $('.km-chegada').after('<span class="label label-success span-status"><i class="fa fa-check"></i> Dentro do permitido</span>');
              $('.confirm-location').attr('disabled', false);
            }
        } else {
          if(parseFloat(val) < parseFloat($('.td1').text())){
            $('.km-chegada').after('<span class="label label-danger span-status"><i class="fa fa-times"></i> Quilometragem de devolução é menor</span>');
            $('.confirm-location').attr('disabled', true);
          } else {
            $('.span-status').remove();
            $('.confirm-location').attr('disabled', false);
          }
        }
      }
    });

    $("input[name='finish_value']").maskMoney({
        prefix:'',
        allowNegative: true,
        thousands:',',
        decimal:'.',
        affixesStay: false
    });

    $(".km-chegada").on("keypress keyup blur",function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    function currencyFormat (num) {
        return num.toFixed(2).replace(",", ".").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    $(document).on('click', '.fa-edit', function(){
        $('.total input').focus();
    });

    $(document).on('click', '.baixar', function(){
        var location = {
            id: $(this).data('id'),
            client: $(this).data('clientid'),
            vehicle: $(this).data('vehicleid'),
            driver: $(this).data('driver'),
            total: $(this).data('total'),
            allowed_km: $(this).data('allowedkm'),
            free_km: $(this).data('freekm'),
            start_km: $(this).data('startkm'),
            tank_check: $(this).data('tankcheck'),
            return_date: $(this).data('returndate'),
            vehicleidenti: $(this).data('vehicleidenti')
        };
        $('.td1').text(location.start_km);

        $('.location-id-hidden').val(location.id);

        if(location.free_km == 0){
            $('.td2').text(location.allowed_km);
            $('.td3').text(parseFloat(location.allowed_km) + parseFloat(location.start_km));
        } else {
            $('.td2').text('LIVRE');
            $('.td3').text('-');
        }

        $('.total input').val(currencyFormat(location.total));
        $('.verify-tank').text('O veículo saiu com "' + location.tank_check + '"');

        $html = location.vehicle + ' locado para ' + location.client + ' com devolução marcada para ' + location.return_date;
        $('.modal-body-locations > h5').html($html);
        $('#modal-location').modal('show');
        $('input[name="vehicle_id"]').val(location.vehicleidenti);
    });

    $(document).on('click', '.confirm-location', function(e){
      e.preventDefault;
      var formData = $('#form-location-finished').serializeArray();

      var url = webroot + 'locations/finish';
      $.post(url, formData, function(e){
        if(e.result.type == 'success'){
          $('#modal-location').modal('hide');
          location.reload();
        }
      },'json');
    });
});
