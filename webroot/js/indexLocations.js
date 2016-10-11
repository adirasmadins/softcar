$(document).ready(function(){
    var formSearch = new Form();
    formSearch.inputMasks({
        '#plate': 'plate'
    });

    $('#plate').keyup(function(){
        this.value = this.value.toUpperCase();
    });
    
    $('.btn-contrato').click(function(){
        $(this).html('<i class="fa fa-refresh fa-spin"></i>').attr('disabled', true);
        var id = $(this).data('id');
        var url = webroot + 'domPdf/generate-contract';
        var data = {
            id: id,
            file_name: 'CONTRATO'
        };
        
        $.post(url, data, function(json){
            if(json.result.type === 'success'){
                window.open(webroot + json.result.data, '_blank'); 
                $('.btn-contrato').html('<i class="fa fa-file-pdf-o"></i>');
            }
        },'json');
    });
});