$(document).ready(function(){
    var formVehicles = new Form;

    $("#picture").change(function () {
        formVehicles.imagePreview(this, $("#target"));
    });

    $("#url").change(function () {
        if ($(this).val().match(/^http/)) {
            $.noop();
        }
        else {
            var cur_val = $(this).val();
            $(this).val('http://' + cur_val);
        }
    });
    $('#type-id').select2();
    $('#fuel-id').select2();

    $('#plate').keyup(function(){
        this.value = this.value.toUpperCase();
    });

    $('#chassi').keyup(function(){
        this.value = this.value.toUpperCase();
    });

    $('#renavam').keyup(function (){
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $("#day-price").maskMoney({
        prefix:'R$ ',
        allowNegative: true,
        thousands:'.',
        decimal:',',
        affixesStay: false
    });

    formVehicles.inputMasks({
        '#plate': 'plate'
    });

    $('#date-fabrication').datepicker({
        language: "pt-BR",
        format: 'yyyy',
        minViewMode: "years"
    });

    $('#date-model').datepicker({
        language: "pt-BR",
        format: 'yyyy',
        minViewMode: "years"
    });

    /**
     * Campos obrigatórios
     */
    $('#formVehicles').validate({
        rules: {
            plate: {
                required: true
            },
            renavam: {
                required: true
            },
            chassi: {
                required: true
            },
            fuel_id: {
                required: true
            },
            mark: {
                required: true
            },
            model: {
                required: true
            },
            date_fabrication: {
                required: true
            },
            date_model: {
                required: true
            },
            color: {
                required: true
            },
            day_price: {
                required: true
            }
        },
        errorPlacement: function(error,element) {
            return true;
        }
    });
});