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
                        title: 'Ops!',
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