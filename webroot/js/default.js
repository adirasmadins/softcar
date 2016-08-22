$(document).ready(function(){
    $('.btn-sair').click(function(){
        swal({
                title: "Deseja sair realmente?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Sim, quero sair",
                cancelButtonText: "Não",
                closeOnConfirm: false
            },
            function(){
                var first_name = user.split(' ');
                swal({
                    title: "OK!",
                    text: "Até a proxima " + first_name[0],
                    type: "success",
                    showConfirmButton: false
                });
                setTimeout(function(){
                    window.location = webroot + 'home/logout';
                }, 1000);
            });
    });
});