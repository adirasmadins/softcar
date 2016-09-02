$(document).ready(function(){
    var populateGrafh = function(){
        NProgress.start();
        var canvas = '<canvas id="myChart" width="200" height="200"></canvas>';
        var url = webroot + 'tickets/populate-graph';
        var formData = $('#formExport').serializeArray();

        $.post(url, formData, function(e){
            var labels = [];
            var data = [];
            var backgrounds = [];
            var color = 90;

            $.each(e.result.data, function(key, value){
                labels.push(value.model);
                data.push(value.qtd_tickets);
                color += 30;
                backgrounds.push('rgb(0,' + color + ',145)');
            });


            $('.col-md-6 > iframe').remove();
            $('#myChart').remove();
            $('.col-md-6.graph').append(canvas);
            var ctx = document.getElementById("myChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgrounds,
                        borderWidth: 1,
                        options: {
                            responsive: true
                        }
                    }]

                }
            });
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

    $(document).on('change', '#vehicle-ids', populateGrafh);
    $(window).load(populateGrafh);
});