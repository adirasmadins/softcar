$(document).ready(function() {
    $('#summernote').summernote();
  
    $('#visualizar').click(function(e){
        $(this).attr('disabled', true);
        NProgress.start();
        e.preventDefault();
        var data = {
                text: $('#summernote').summernote('code')
            };
        var url = webroot + 'domPdf/getPdf';
        
        $.post(url, data, function(e){
            if(e){
                var btnAbrir = $('#abrir');
                
                btnAbrir.attr('href', webroot + e.arquivo);
                btnAbrir.attr('target', '_blank');
                btnAbrir.show();
                NProgress.done();
                $(this).attr('disabled', false);
            }
        },'json');
    });
});