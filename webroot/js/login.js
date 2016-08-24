$(function(){
    $('#logar').click(function(){
        $('#logar').html('<i class="fa fa-refresh fa-spin"></i> Entrando').attr('disabled',true);
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
    });
});