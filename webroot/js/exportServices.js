$(document).ready(function(){
    $('input[type="radio"]').iCheck({
        radioClass: 'iradio_square-blue'
    });

    var populateGrafh = function(){
        NProgress.start();
        var canvas = '<canvas id="myChart" width="200" height="200"></canvas>';
        var url = webroot + 'services/populate-graph';
        var formData = $('#formExport').serializeArray();
        var type = $('input[type="radio"]:checked').val();

        $.post(url, formData, function(e){
            var labels = [];
            var data = [];
            var backgrounds = [];

            if(e.result.type === 'success'){
                $.each(e.result.data, function(key, value){
                    labels.push(value.model + ' (' + value.plate + ')');
                    data.push(value.qtdService);
                    backgrounds.push(Please.make_color());
                });


                $('.col-md-6 > iframe').remove();
                $('#myChart').remove();
                $('.col-md-6.graph').append(canvas);
                var ctx = document.getElementById("myChart").getContext("2d");
                var chart = new Charts();
                var label = 'Quantidade de Manutenções';
                chart.getChart(type, labels, data, backgrounds, ctx, label);
            }
            NProgress.done();
        },'json');
    };

    $('#vehicle-ids, #service-type').select2();
    $('#from-date, #to-date').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $('#from-date, #to-date, #vehicle-ids, #service-type').change(function(){
        $('#download').hide();
        $('#generatePdf').html('<i class="fa fa-file-pdf-o"></i> Exportar Gráfico').attr('disabled', false).show();
        $('#abrir').hide();
    });

    $('#generateFile').click(function(e){
        e.preventDefault();
        $('#generateFile').html('<i class="fa fa-cog fa-spin"></i> gerando relatório...');
        var url = webroot + 'services/generate-export';
        var data = {
            from_date: $('#from-date').val(),
            to_date: $('#to-date').val(),
            vehicle_ids: $('#vehicle-ids').val(),
            service_type: $('#service-type').val()
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
            title: 'Quantidade de Manutenções',
            file_name: 'grafico_de_manutencoes'
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

    $(document).on('click', '#update-graph', populateGrafh);
    $(window).load(populateGrafh);
});
