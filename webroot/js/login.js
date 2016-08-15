$(function(){
    $('#logar').click(function(){
        $('#logar').html('<i class="fa fa-refresh fa-spin"></i> Entrando').attr('disabled',true);
        var formData = $('#formLogin').serializeArray();
        var url = webroot + 'home/login';

        $.post(url,formData,function(e){
            if(e.result.type == 'error'){
                swal({
                    title: "Que pena, deu errado!",
                    text: "Login não foi realizado",
                    type: 'error',
                    confirmButtonClass: 'btn-danger'
                });
                $('#logar').html('Entrar').attr('disabled',false);
            } else {
                setTimeout(function(){
                    window.location = webroot + 'dashboard/index';
                }, 3000);
                swal({
                    title: "Bem vindo(a), " + e.result.data,
                    text: "Você será redirecionado(a) em 3 segundos",
                    timer: 3000,
                    type: 'success',
                    showConfirmButton: false
                });
            }
        },'json');
    });
});