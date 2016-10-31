$(document).ready(function(){
    $('.km-chegada').change(function(){
        if($(this).val() < parseFloat($('.td1').text())){
            $('.span-status').remove();
            $('.km-chegada').after('<span class="label label-danger span-status"><i class="fa fa-times"></i> Quilometragem de devolução é menor</span>');
        } else {
            $('.span-status').remove();
        }
    });

    $('.km-chegada').keyup(function(){
        if(($(this).val()) && ($('.td2').text() != 'LIVRE')){
            $('.span-status').remove();

            if(parseFloat($(this).val()) > parseFloat($('.td3').text())){
                $('.km-chegada').after('<span class="label label-warning span-status">Fora do permitido - passaram ' + (parseFloat($(this).val())-parseFloat($('.td3').text())) + 'km</span>');
            } else {
                $('.km-chegada').after('<span class="label label-success span-status">Dentro do permitido</span>');
            }
        }
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
            return_date: $(this).data('returndate')
        };
        $('.td1').text(location.start_km);

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
    });
});