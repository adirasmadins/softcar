$(document).ready(function(){
    var formSearch = new Form();
    formSearch.inputMasks({
        '#plate': 'plate'
    });

    $('#plate').keyup(function(){
        this.value = this.value.toUpperCase();
    });
    
    $('.btn-contrato').click(function(){
        var id = $(this).data('id');
        var url = webroot + 'domPdf/generate-contract';
        var data = {
            id: id,
            file_name: 'CONTRATO'
        };
        
        $.post(url, data, function(json){
            if(json.result.type === 'success'){
                swal({   
                    title: "HTML <small>Title</small>!",   
                    text: "A custom <span style="color:#F8BB86">html<span> message.",   
                    html: true 
                });
            }
        },'json');
    });
});