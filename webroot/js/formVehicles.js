$(document).ready(function(){
    $('#type-id').select2();
    $('#fuel-id').select2();

    var ehPlacaValida = function( placa ){
        var er = /[a-z]{3}-?\d{4}/gim;
        er.lastIndex = 0;
        return er.test( placa );
    };

    var formVehicles = new Form;
    formVehicles.inputMasks({
        '#day-price': 'decimal-7-2'
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
                required: true,
            }
        },
        errorPlacement: function(error,element) {
            return true;
        }
    });
});