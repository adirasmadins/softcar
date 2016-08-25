$(document).ready(function(){
    $('#type-id').select2();
    $('#fuel-id').select2();

    var formVehicles = new Form;
    formVehicles.inputMasks({
        '#day-price': 'decimal-7-2'
    });

    $('#date-fabrication').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy',
        viewMode: 'years'
    });

    $('#date-model').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy',
        viewMode: 'years'
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