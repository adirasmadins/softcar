$(document).ready(function(){
    $('input[type="radio"]').iCheck({
        radioClass: 'iradio_square-blue'
    });

    var populateGrafh = function(){
        NProgress.start();
        var canvas = '<canvas id="myChart" width="200" height="200"></canvas>';
        var url = webroot + 'locations/populate-graph';
        var formData = $('#formExport').serializeArray();
        var type = $('input[type="radio"]:checked').val();

        $.post(url, formData, function(e){
            var labels = [];
            var data = [];
            var backgrounds = [];

            if(e.result.type === 'success'){
                $.each(e.result.data, function(key, value){
                    labels.push(value.model + ' (' + value.plate + ')');
                    data.push(value.qtdLocations);
                    backgrounds.push(Please.make_color());
                });

                $('.col-md-6 > iframe').remove();
                $('#myChart').remove();
                $('.col-md-6.graph').append(canvas);
                var ctx = document.getElementById("myChart").getContext("2d");
                var chart = new Charts();
                var label = 'Quantidade de Locações';
                chart.getChart(type, labels, data, backgrounds, ctx, label);
            }
            NProgress.done();
        },'json');
    };

    $('#vehicle-ids').select2();
    $('#out-date, #return-date').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $('#out-date, #return-date, #vehicle-ids').change(function(){
        $('#download').hide();
        $('#generatePdf').html('<i class="fa fa-file-pdf-o"></i> Exportar Gráfico').attr('disabled', false).show();
        $('#abrir').hide();
    });

    $('#generateFile').click(function(e){
        e.preventDefault();
        $('#generateFile').html('<i class="fa fa-cog fa-spin"></i> gerando relatório...');
        var url = webroot + 'tickets/generate-export';
        var data = {
            from_date: $('#out-date').val(),
            to_date: $('#return-date').val(),
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

    $('input[type="radio"]').on('ifChecked', function(){
        $('#abrir').hide();
        $('#generatePdf').html('<i class="fa fa-file-pdf-o"></i> Exportar Gráfico').attr('disabled', false).show();
        populateGrafh();
    });

    $('#generatePdf').click(function(e){
        NProgress.start();
        e.preventDefault();
        var button = $('#generatePdf');
        $(this).html('<i class="fa fa-cog fa-spin"></i> gerando PDF...').attr('disabled', true);
        var url_base64 = document.getElementById('myChart').toDataURL('image/png');
        var data = {
            url: url_base64,
            title: 'Gráfico de Locações por Veículo',
            file_name: 'grafico_de_locacoes'
        };
        $.post(webroot + 'charts/getPdf', data, function(e){
            if(e){
                var btnAbrir = $('#abrir');
                button.hide();
                btnAbrir.attr('href', webroot + e.arquivo);
                btnAbrir.attr('target', '_blank');
                btnAbrir.show();
                NProgress.done();
            }
        },'json');
    });

    $(document).on('change', '#vehicle-ids', populateGrafh);
    $(window).load(populateGrafh);
});