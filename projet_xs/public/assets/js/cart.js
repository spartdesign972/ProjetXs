$(function(){

    // Ajout au panier
    $('body').on('click', '.addCart', function(e){
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            method: 'post',
            url: $this.attr('href'),
            dataType: 'json',
            success: function(result){
                swal('', result.message, result.status);
            }
        });
    });

})