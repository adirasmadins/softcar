$(document).ready(function () {
    var formDrivers=new Form();
    formDrivers.inputMasks({
        '#phone': 'phone',
        '#cel-phone': 'phone',
        '#cpf': 'cpf',
        '#rg': 'rg',
        '#cep': 'cep'

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

    $('#formUsers').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            gender: {
                required: true
            },
            cpf: {
                required: true
            },
            rg: {
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
            login: {
                required: true
            },
            password: {
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

});
