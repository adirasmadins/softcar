$(document).ready(function () {
    var formDrivers=new Form();
    formDrivers.inputMasks({
        '#phone': 'phone',
        '#cel-pgir statuhone': 'phone',
        '#cpf': 'cpf',
        '#rg': 'rg',
        '#cep': 'cep',
        '#first-license': 'date',
        '#validity-cnh': 'date',
        '#birth-date': 'date'

    });

    $('#state-id').change(popularCityInAdd);
    if($('#state-id').val() > 0) {
        popularCityInEdit();
    }
    function popularCityInAdd(){
        var options = "";

        var url = webroot + '/utils/cities-list';
        var data = {
            id: $('#state-id').val()
        };
        $('#select2-city-id-container').text('buscando cidade...');

        $.post(url,data, function(e){
            if(e.result.status === 'success'){
                $.each(e.result.data, function(key, value){
                    options += "<option value=" + value.id + ">" + value.name + "</option>";
                });
                $('#select2-city-id-container').text('Selecione a cidade');
                $("#city-id").html(null);
                $("#city-id").html(options);
                $('#city-id').attr('disabled', false);
            }
        },'json');
    }
    function popularCityInEdit(){
        var options = "";

        var url = webroot + '/utils/cities-list';
        var data = {
            id: $('#state-id').val()
        };
        $('#select2-city-id-container').text('buscando cidade...');

        $.post(url,data, function(e){
            if(e.result.status === 'success'){
                var selected = 'selected="selected"';
                $.each(e.result.data, function(key, value){
                    if(value.id == $('#city-id-hidden').val()){
                        $('#select2-city-id-container').text(value.name);
                        options += "<option value=" + value.id + " selected>" + value.name + "</option>";
                    } else {
                        options += "<option value=" + value.id + ">" + value.name + "</option>";
                    }
                });

                $("#city-id").html(null);
                $("#city-id").html(options);
                $('#city-id').attr('disabled', false);
            }
        },'json');
    }

    $('#number, #cnh').keyup(function (){
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    $('#name').keyup(function(){
        this.value = this.value.replace(/[^a-zA-Záàâãéèêíïóôõöúçñ ]+/g, '');
    });

    $('#formDrivers').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            gender: {
                required: true
            },
            cpf_cnpj: {
                required: true
            },
            rg_ie: {
                required: true
            },
            phone: {
                required: true
            },
            cel_phone: {
                required: true
            },
            number: {
                required: true
            },
            neighborhood: {
                required: true
            },
            street: {
                required: true
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            }
        },
        errorPlacement: function(error,element) {
            return true;
        }
    });

    $('#first-license').change(function(){
        $(this).datepicker('hide');
        moment.locale('pt-br');
        var data1 = moment($(this).val(),'DD/MM/YYYY');
        var data2 = moment(moment().format('DD/MM/YYYY'),'DD/MM/YYYY');
        var diff  = data2.diff(data1, 'days');

        if(diff <= 731){
            $('button[type="submit"]').attr('disabled', true);
            swal({
                title: 'Cliente não possui data mínima',
                text: 'É necessário ter pelo menos 2 anos de CNH',
                type: 'info',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        } else {
            $('button[type="submit"]').attr('disabled', false);
        }
    });

    $('#birth-date').change(function(){
        moment.locale('pt-br');
        var data1 = moment($(this).val(),'DD/MM/YYYY');
        var data2 = moment(moment().format('DD/MM/YYYY'),'DD/MM/YYYY');
        var diff  = data2.diff(data1, 'days');

        if(diff <= 7300){
            $('button[type="submit"]').attr('disabled', true);
            swal({
                title: 'Cliente não possui idade mínima',
                text: 'É necessário ter pelo menos 20 anos de idade',
                type: 'info',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        } else {
            $('button[type="submit"]').attr('disabled', false);
        }
    });

    $('#cpf').change(function(){
        var val = $(this).val();

        value = $.trim(val);
        value = value.replace('.', '');
        value = value.replace('.', '');
        value = value.replace('-', '');

        var parent = $(this).parent();
        var label = parent.parent('label');
        if(value.length === 11){
            var valid = formDrivers.validarCpf(val);
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

});
