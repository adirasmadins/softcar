$(document).ready(function(){
    var formClients = new Form;

    $('#cpf-cnpj').change(function(){
        var val = $(this).val();
        var parent = $(this).parent();
        var label = parent.parent('label');

        if(val === ""){
            $(this).css("border-left","");
            parent.children('span').remove();
        }

        value = $.trim(val);
        value = value.replace('.', '');
        value = value.replace('.', '');
        value = value.replace('-', '');
        value = value.replace('/', '');

        var valid = '';
        if(value.length === 11){
            valid = formClients.validarCpf(val);
        } else if (value.length === 14){
            valid = formClients.validarCnpj(val);
        }

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

    });

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
    $('#validity-cnh').datepicker({
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
    formClients.inputMasks({
        '#phone': 'phone',
        '#cel-phone': 'phone',
        '#cpf-cnpj': 'cpf_cnpj',
        '#rg-ie': 'rg',
        '#cep': 'cep',
        '#birth-date': 'date',
        '#validity-cnh': 'date',
        '#first-license': 'date'
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

        var url = webroot + 'utils/cities-list';
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

        var url = webroot + 'utils/cities-list';
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

    $('#first-license').change(function(){
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

    $('#validity-cnh').change(function(){
        moment.locale('pt-br');
        var data1 = moment($(this).val(),'DD/MM/YYYY');
        var data2 = moment(moment().format('DD/MM/YYYY'),'DD/MM/YYYY');
        var diff  = data2.diff(data1, 'days');
        if(diff >= 0){
            $('button[type="submit"]').attr('disabled', true);
            swal({
                title: 'Validade da Carteira de Motorista',
                text: 'A carteira do cliente está vencida',
                type: 'info',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        } else {
            $('button[type="submit"]').attr('disabled', false);
        }
    });
});

$(document).ready(function() {

  $("#client_files").on("change", handleFileSelect);
  selDiv = $("#selectedFilesD");
  $(document).on("click", ".selFile", removeFile);
});

var selDiv = "";
var storedFiles = [];

function handleFileSelect(e) {

  var files = e.target.files;
  var filesArr = Array.prototype.slice.call(files);
  var device = $(e.target).data("device");
  filesArr.forEach(function(f) {

    if (!f.type.match("image.*")) {
      return;
    }
    storedFiles.push(f);

    var reader = new FileReader();
    reader.onload = function(e) {
      var html = "<div><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='thumbnail selFile'></div>";

      if (device == "mobile") {
        $("#selectedFilesM").append(html);
      } else {
        $("#selectedFilesD").append(html);
      }
    }
    reader.readAsDataURL(f);
  });
}

function removeFile(e) {
  var file = $(this).data("file");
  for (var i = 0; i < storedFiles.length; i++) {
    if (storedFiles[i].name === file) {
      storedFiles.splice(i, 1);
      break;
    }
  }
  $(this).parent().remove();
}
