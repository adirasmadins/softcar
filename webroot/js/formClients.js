$(document).ready(function(){
    var formClients = new Form;

    $('#state-id').change(popularCityInAdd);
    if($('#state-id').val() > 0){
        popularCityInEdit();
    }

    /**
     * Bloco definindo campos que serão select2 (selecão com consulta)
     */
    $('#gender, #city-id, #state-id').select2();

    /**
     * Colocando Calendário
     */
    $('#birth-date, #validity-cnh, #first-license').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    /**
     * Expressões regulares
     */
    $('#number').keyup(function (){
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    $('#name').keyup(function(){
        this.value = this.value.replace(/[^a-zA-Z]+/g, '');
    });

    /**
     * Definindo máscaras
     * @type {Form}
     */
    formClients.inputMasks({
        '#phone': 'phone',
        '#cel-phone': 'phone',
        '#cpf-cnpj': 'cpf',
        '#rg-ie': 'rg',
        '#cep': 'cep'
    });


    /**
     * Campos obrigatórios
     */
    $('#formClients').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            gender: {
                required: true
            },
            birth: {
                require: true
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
                required: false
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

    /**
     * Função de Popular Select na ação de Adicionar
     */
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

    /**
     * Função de Popular Select na ação Editar
     */
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

    $('#first-license').change(function(){
        var firstLicense = $(this).val();
    });

});