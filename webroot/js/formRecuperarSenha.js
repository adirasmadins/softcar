$(document).ready(function(){
    var valid = false;
    $('#password-new-repeat').keyup(function(){
        if($('#password-new').val() === $('#password-new-repeat').val()){
            $('.warning-icon').hide();
            $('.success-icon').show();
            valid = true;
        } else {
            valid = false;
            $('.warning-icon').show();
            $('.success-icon').hide();
        }
    });

    $('#recuperar').click(function(){
        if(valid){
            var url = webroot + 'users/change-password';
            var id = $('#id-user').val();
            var password = $('#password-new-repeat').val();

            var data = {
                id: id,
                password: password
            };
            $.post(url, data, function(e){
                if(e.result.type === 'success'){
                    swal({
                            title: "Recuperação de Senha realizada com sucesso!",
                            text: "Confirme para realizar o login com sua nova senha",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                            closeOnConfirm: false
                        },
                        function(){
                            window.location = webroot + 'home/login';
                        });
                } else {
                    swal("Não foi possível realizar a recuperação de senha", "", "error");
                    window.location = webroot + 'home/login';
                }
            },'json');
        } else {
            swal({
                title: 'Ops!',
                text: 'As senhas precisam ser iguais',
                showCancelButton: false,
                type: 'error',
                showConfirmButton: true,
                closeOnConfirm: true
            });
        }
    });
});