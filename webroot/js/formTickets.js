$(document).ready(function(){
    $('#vehicle-id, #client-id').select2();

    $('#not-registered').iCheck({
        checkboxClass: 'icheckbox_flat-blue'
    });

    if($('#value-description').val().length){
        $('#description').val($('#value-description').val());
    }

    if($('#not-registered').prop('checked')){
        $('.dados-client').hide();
        $('#client-id').attr('disabled', true);
        $('.view-not-registered').show();
    }

    $('.view-not-registered').click(function(){
        $('#not-registered-modal').modal('show');
    });

    $(document).on('click','.save-modal', function(){
        var name = $('#name-not-registered').val();
        var rg = $('#rg-not-registered').val();
        var cpf = $('#cpf-not-registered').val();

        if((name.length > 0) || (rg.length > 0) || (cpf.length > 0)){
            $('.view-not-registered').show();
        }
        if((name.length <= 0) && (rg.length <= 0) && (cpf.length <= 0)){
            $('#not-registered').iCheck('uncheck');
        }
    });

    $('#not-registered').on('ifChecked', function(event){
        $('#client-id').val('').attr('disabled', true);
        $('.dados-client').hide();
        $('#not-registered-modal').modal('show');
    }).on('ifUnchecked', function(){
        $('#cpf-not-registered, #rg-not-registered, #name-not-registered').val('');
        $('.view-not-registered').hide();
        $('.dados-client').show();
        $('#client-id').attr('disabled', false);
    });

    var formTickets = new Form();
    formTickets.inputMasks({
        '#cpf-not-registered': 'cpf',
        '#rg-not-registered': 'rg',
        '#due-date': 'date',
        '#ticket-date': 'date'
    });

    $('#due-date, #ticket-date').datepicker({
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

    if($('#vehicle-id').val().length > 0){
        infoCar();
    }

    if($('#client-id').val().length > 0){
        infoClient();
    }
    $(document).on('change','#client-id', infoClient);
    $(document).on('change','#vehicle-id', infoCar);

    $('#formTickets').validate({
        rules: {
            vehicle_id: {
                required: true
            },
            client_id: {
                required: true
            },
            description: {
                required: true
            },
            value: {
                required: true
            },
            due_date: {
                required: true
            },
            ticket_date: {
                required: true
            }
        },
        errorPlacement: function(error,element) {
            return true;
        }
    });

    $('#cpf-not-registered').change(function(){
        var val = $(this).val();

        value = $.trim(val);
        value = value.replace('.', '');
        value = value.replace('.', '');
        value = value.replace('-', '');

        var parent = $(this).parent();
        var label = parent.parent('label');
        if(value.length === 11){
            var valid = formTickets.validarCpf(val);
            parent.children('span').remove();

            if(!valid){
                parent.after(label).prepend('<span class="label label-danger pull-right"><i class="fa fa-ban"></i> Inválido</span>');
                $(this).css("border-left","2px solid #dd4b39");
                $('button[type="submit"]').attr('disabled', true);
            } else {
                parent.after(label).prepend('<span class="label label-success pull-right"><i class="fa fa-check"></i> Válido</span>');
                $(this).css("border-left","2px solid #00a65a");
                $('button[type="submit"]').attr('disabled', false);
            }
        } else if ($(this).val() === ''){
            $(this).css("border-left","");
            parent.children('span').remove();
        }
    });

    $('#due-date').change(function(){
        moment.locale('pt-br');
        var data1 = moment($("#ticket-date").val(),'DD/MM/YYYY');
        var data2 = moment($(this).val(),'DD/MM/YYYY');
        var diff  = data2.diff(data1, 'days');
        console.log(diff);
        if(diff <= 0){
            $('button[type="submit"]').attr('disabled', true);
            swal({
                title: 'Data incorreta',
                text: 'A Data de Vencimento não pode ser menor que a Data da Multa',
                type: 'info',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        } else {
            $('button[type="submit"]').attr('disabled', false);
        }
    });
});
