$(function(){
    $('#logar').click(function(){
        if($('#login').val() != '' && $('#password').val() != ''){
            $(this).html('<i class="fa fa-refresh fa-spin"></i> Entrando').attr('disabled',true);
            var formData = $('#formLogin').serializeArray();
            var url = webroot + 'home/login';

            $.post(url,formData,function(e){
                console.log(e.result);
                if(e.result.type == 'error'){
                    swal({
                        title: e.result.title,
                        text: e.result.text,
                        type: 'error',
                        confirmButtonClass: 'btn-danger'
                    });
                    $('#logar').html('Entrar').attr('disabled',false);
                } else {
                    setTimeout(function(){
                        window.location = webroot + 'dashboard/index';
                    }, 3000);
                    swal({
                        title: e.result.title,
                        text: e.result.text,
                        timer: 3000,
                        type: 'success',
                        showConfirmButton: false
                    });
                }
            },'json');
        }
    });

    $('#esqueci-senha').click(function(){
        swal({
            title: "Esqueceu sua senha?",
            text: "Digite seu email",
            type: "input",
            showCancelButton: true,
            closeOnCancel: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Enviar',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            inputPlaceholder: "Email",
            confirmButtonClass: 'btn btn-success'
        }, function (inputValue) {
            if(inputValue != ''){
                var url = webroot + 'users/recover-password';
                var data = {email: inputValue};

                $.post(url, data, function(e){
                    if(e.result.type === 'success'){
                        swal({
                            title: 'Verifique seu e-mail',
                            text: 'Enviamos um email para <b>' + inputValue + '</b> com confirmação de recuperação de senha',
                            showCancelButton: false,
                            type: 'success',
                            showConfirmButton: true,
                            closeOnConfirm: true,
                            html: true
                        });
                    } else if (e.result.type === 'not_user'){
                        swal({
                            title: 'Ops!',
                            text: 'Email: ' + inputValue + ', não está cadastrado',
                            showCancelButton: false,
                            type: 'error',
                            showConfirmButton: true,
                            closeOnConfirm: true
                        });
                    }
                },'json');
            }
        });
    });
});