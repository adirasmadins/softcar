$(document).ready(function(){
    $('#client-id').select2();
    $('input[type="radio"]').iCheck({
        radioClass: 'iradio_square-blue'
    });

    $('#carregar').attr('disabled', true);
    $('#reserves').modal('show');

    $('input[type="radio"]').on('ifChecked', function(){
        $('#carregar').attr('disabled', false);
    });

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

    $(document).on('change', '#client-id', infoClient);
    $(document).on('click', '#carregar', function(){
        var infos = ['out-date','return-date','remove_schedule','devolution_schedule','client-id'];
        $.each(infos, function(k,v){
            $('#' + v).attr('disabled', true);
        });

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

                $('#reserves').modal('hide');
            }
        },'json');
    });
});