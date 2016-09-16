$(document).ready(function(){
    var formSearch = new Form;
    formSearch.inputMasks({
        '#plate': 'plate'
    });
    
    $('#plate').keyup(function(){
        this.value = this.value.toUpperCase();
    });
});