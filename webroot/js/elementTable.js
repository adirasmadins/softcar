$(document).ready(function() {
    $(document).on('click', '#btn-deletar', function() {
        var id = $(this).data('id');
        swal({
            title: "Deseja realmente apagar este registro?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim, quero apagar',
            confirmButtonClass: "btn-danger",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function() {
            var url = webroot + entity + '/delete';
            var data = {
                id: id
            };
            $.post(url, data, function(e) {
                if (e.result.type === 'success') {
                    swal({
                        title: type + e.result.data + ' foi apagado(a) com sucesso!',
                        showCancelButton: false,
                        type: 'success',
                        showConfirmButton: false
                    });
                    location.reload();
                }
                else if (e.result.type === 'error') {
                    swal('Houve algum problema ao apagar este registro', '', 'danger');
                }
                else {
                    swal({
                        title: 'Problema ao excluir',
                        text: 'Esse registro possui vínculo, não é possível excluir!',
                        showCancelButton: true,
                        type: 'error',
                        showConfirmButton: false,
                        cancelButtonText: 'OK'
                    });
                }
            }, 'json');
        });
    });

    $('.btn-flash').mouseover(function() {
        var url = $(this).data('url');
        var model = $(this).data('model');
        var position = $(this).offset();
        var div = $('.view-vehicle');
        var heightDiv = $('.view-vehicle').height();
        var heightTela = window.innerHeight;

        if ((position.top + heightDiv) > heightTela) {
            div.css('top', position.top - heightDiv - 80);
        }
        else {
            div.css('top', position.top);
        }
        if (url != '') {
            $('.view-vehicle > h4').html(model);
            $('.view-vehicle > img').attr('src', (webroot + url).replace('//', '/'));
        }
        else {
            $('.view-vehicle > h4').html('Cadastro sem imagem!');
            $('.view-vehicle > img').attr('src', webroot + 'img/no_image.jpg');
        }
        div.show();
    }).mouseout(function() {
        var div = $('.view-vehicle');
        div.hide();
    });

    $('.btn-pay').mouseover(function() {
        var position = $(this).offset();
        var div = $('.tooltip-ticket');
        div.css('top', position.top);
        div.show();
    }).mouseout(function() {
        $('.tooltip-ticket').hide();
    });

    $('.btn-info-location').click(function() {
      if($('.tooltip-info').is(':visible')){
        $('.tooltip-info').hide();
      } else {
        var position = $(this).offset();
        var div = $('.tooltip-info');
        div.css('top', position.top);

        var data = {
          id: $(this).data('id')
        };

        $.get(webroot + 'locations/get-all-info-location', data, function(e){
          $('.calc-in').show();
          if(e.result.type == 'success'){
            $('.iniciou td:nth-child(1)').text(e.result.data.location.start_km);
            $('.iniciou td:nth-child(2)').text('R$ ' + currencyFormat(e.result.data.location.total));
            $('.iniciou td:nth-child(3)').text(e.result.data.location.tank_check);
            $('.entregou td:nth-child(1)').text(e.result.data.finished.finish_km);
            $('.entregou td:nth-child(2)').text('R$ ' + currencyFormat(e.result.data.finished.finish_value));
            $('.entregou td:nth-child(3)').text(e.result.data.finished.finish_tank);
            var diff = parseFloat(e.result.data.finished.finish_value) - parseFloat(e.result.data.location.total);
            var text = diff < 0 ? 'desconto' + ' de R$ ' + currencyFormat(diff) + ' reais' : 'acréscimo' + ' de R$ ' + currencyFormat(diff) + ' reais';
            text += '<br/>A quilometragem ';

            if(e.result.data.location.free_km == 1){
              text += 'foi livre';
            } else {
              var kmTotal = (parseFloat(e.result.data.location.start_km) + parseFloat(e.result.data.location.allowed_km));
              if(kmTotal >= e.result.data.finished.finish_km){
                text += 'ficou dentro do permitido (' + kmTotal + 'km)';
              } else {
                var diffKm = parseFloat(e.result.data.finished.finish_km) - kmTotal;
                text += 'ultrapassou o permitido em ' + diffKm + 'km';
              }
            }

            $('.infos').html('Houve um ' + text);
            $('.calc-in').hide();
          }
        },'json');

        div.show();
      }
    }).mouseover(function() {
        var position = $(this).offset();
        var div = $('.tooltip-info-msg');
        div.css('top', position.top);
        div.show();
    }).mouseout(function() {
        $('.tooltip-info-msg').hide();
    });

    function currencyFormat (num) {
        return num.toFixed(2).replace(",", ".").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    $('.btn-contrato').mouseover(function() {
        var position = $(this).offset();
        var div = $('.tooltip-contract');
        div.css('top', position.top);
        div.show();
    }).mouseout(function() {
        $('.tooltip-contract').hide();
    });

    $('.btn-pay').click(function() {
        var id = {
            id: $(this).data('id')
        };
        var url = webroot + 'tickets/payTicket';
        $(this).attr('disabled', true).html('<i class="fa fa-refresh fa-spin"></i>');
        $.post(url, id, function(e) {
            if (e.result.type === 'success') {
                swal({
                    title: 'Pagamento efetuado com sucesso!',
                    text: "Valor: R$ " + e.result.data.value,
                    showCancelButton: false,
                    type: 'success',
                    showConfirmButton: false,
                    time: 2000
                });
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
            else {
                swal({
                    title: 'Houve um problema ao efetuar o pagamento!',
                    text: '',
                    showCancelButton: false,
                    type: 'error',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            }
        }, 'json');
    });
});
