$(document).ready(function(){
    var formUsers = new Form;

    $('#cpf').change(function(){
        var val = $(this).val();

        value = $.trim(val);
        value = value.replace('.', '');
        value = value.replace('.', '');
        value = value.replace('-', '');

        var parent = $(this).parent();
        var label = parent.parent('label');
        if(value.length === 11){
            var valid = formUsers.validarCpf(val);
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

    $('#state-id').change(popularCityInAdd);
    if($('#state-id').val() > 0){
        popularCityInEdit();
    }

    /**
     * Bloco definindo campos que serão select2 (selecão com consulta)
     */
    $('#gender, #city-id, #state-id, #profile-id, #status').select2();

    /**
     * Colocando Calendário
     */
    $('#birth-date').datepicker({
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
        this.value = this.value.replace(/[^a-zA-Záàâãéèêíïóôõöúçñ ]+/g, '');
    });

    /**
     * Definindo máscaras
     * @type {Form}
     */
    formUsers.inputMasks({
        '#phone': 'phone',
        '#cel-phone': 'phone',
        '#cpf': 'cpf',
        '#rg': 'rg',
        '#cep': 'cep'
    });


    /**
     * Campos obrigatórios
     */
    $('#formUsers').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            gender: {
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
            },
            email: {
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

});