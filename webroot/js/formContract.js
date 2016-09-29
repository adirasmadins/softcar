$(document).ready(function() {
    $('#summernote').summernote();
  
    $('#visualizar').click(function(e){
        $(this).attr('disabled', true);
        NProgress.start();
        e.preventDefault();
        var data = {
            texto: $('#summernote').summernote('code'),
            file_name: 'pre-visualizacao-pdf'
        };
        var url = webroot + 'domPdf/preVisualizar';

        $.post(url, data, function(e){
            if(e){
                window.open(webroot + e.arquivo,'_blank');
                NProgress.done();
                $(this).attr('disabled', false);
            }
        },'json');
    });
});