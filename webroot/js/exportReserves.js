$(document).ready(function(){
    $('#vehicle-ids, #status').select2();
    $('#date-start, #date-end').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $('#generateFile').click(function(e){
        e.preventDefault();
        $('#generateFile').html('<i class="fa fa-cog fa-spin"></i> gerando relatório...');
        var url = webroot + 'reserves/generate-export';
        var data = {
            from_date: $('#date-start').val(),
            to_date: $('#date-end').val(),
            vehicle_ids: $('#vehicle-ids').val()
        };

        $.post(url, data, function (r) {
            if (r.result.status == 'success') {
                $('#download').attr('href', webroot + r.result.url).show('100');
                $('#generateFile').html('<i class="fa fa-file-excel-o"></i> Gerar Relatorio');
            } else {
                alert(r.result.message);
            }
        }, 'json')
    });
});