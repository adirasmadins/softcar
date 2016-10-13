$(document).ready(function() {
    $('#summernote').summernote({
        height: 300        
    });
  
    $('#visualizar').click(function(e){
        $(this).attr('disabled', true);
        $(this).after('<span class="span-msg"><i class="fa fa-cog fa-spin"></i> gerando pré visualização ...</span>');
        NProgress.start();
        e.preventDefault();
        var data = {
            texto: $('#summernote').summernote('code'),
            file_name: 'pre-visualizacao-pdf'
        };
        var url = webroot + 'domPdf/preVisualizar';

        $.post(url, data, function(e){
            console.log(e);
            if(e){
                window.open(webroot + e.arquivo,'_blank');
                NProgress.done();
                $('#visualizar').attr('disabled', false);
                $('.span-msg').fadeOut('fast');
            }
        },'json');
    });
});