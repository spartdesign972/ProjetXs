function to_like(url){

    $('.my-like').each(function(){
        // Chargement du bouton Like
        var $likeButton = $(this);
        var resHTML = '';
        $.ajax({
            method: 'post',
            url: url,
            data: {user_id: $likeButton.data('user'), prod_id: $likeButton.data('id'), action: 'search'},
            dataType: 'json',
            success: function(result){
                if(result.status == 'success') {
                    $likeButton.html('<a href="'+url+'" class="btn btn-default" role="button"> <i class="fa fa-heart like-'+result.my_like+'" aria-hidden="true"></i></a>');
                }
            }
        });

        // Click sur bouton Like
        $likeButton.click(function(e){
            e.preventDefault();
            $.ajax({
                method: 'post',
                url: $likeButton.find('a').attr('href'),
                data: {user_id: $likeButton.data('user'), prod_id: $likeButton.data('id')},
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success') {
                        $likeButton.html('<a href="'+url+'" class="btn btn-default" role="button"> <i class="fa fa-heart like-'+result.my_like+'" aria-hidden="true"></i></a>');
                        $likeButton.prev('.nb-like').html(result.likes_count + ' <i class="fa fa-heart" aria-hidden="true"></i>')
                    }
                }
            });
        });
    })
}
