$(document).ready(function(){
    $('input[type="radio"]').iCheck({
        radioClass: 'iradio_square-blue'
    });

    var populateGrafh = function(){
        NProgress.start();
        var canvas = '<canvas id="myChart" width="200" height="200"></canvas>';
        var url = webroot + 'tickets/populate-graph';
        var formData = $('#formExport').serializeArray();
        var type = $('input[type="radio"]:checked').val();

        $.post(url, formData, function(e){
            var labels = [];
            var data = [];
            var backgrounds = [];
            var color = 90;

            if(e.result.type === 'success'){
                $.each(e.result.data, function(key, value){
                    labels.push(value.model + ' (' + value.plate + ')');
                    data.push(value.qtdTickets);
                    color += 30;
                    backgrounds.push('rgb(0,' + color + ',145)');
                });

                $('.col-md-6 > iframe').remove();
                $('#myChart').remove();
                $('.col-md-6.graph').append(canvas);
                var ctx = document.getElementById("myChart").getContext("2d");
                var chart = new Charts();
                chart.getChart(type, labels, data, backgrounds, ctx);
            }
            NProgress.done();
        },'json');
    };

    $('#vehicle-ids, #status').select2();
    $('#from-date, #to-date').datepicker({
        language: "pt-BR",
        format: 'dd/mm/yyyy'
    });

    $('#from-date, #to-date, #vehicle-ids, #status').change(function(){
        $('#download').hide();
    });

    $('#generateFile').click(function(e){
        e.preventDefault();
        $('#generateFile').html('<i class="fa fa-cog fa-spin"></i> gerando relatório...');
        var url = webroot + 'tickets/generate-export';
        var data = {
            from_date: $('#from-date').val(),
            to_date: $('#to-date').val(),
            vehicle_ids: $('#vehicle-ids').val(),
            status: $('#status').val()
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

    $(document).on('change', '#vehicle-ids', populateGrafh);
    $(window).load(populateGrafh);
});