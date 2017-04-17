// Suppression AJAX
function ajax_delete(selector, title) {

    $('body').on('click', selector, function(e){
        e.preventDefault();

        var $deleteButton = $(this);
        swal({
            title: title,
            text: "Voulez-vous continuer ?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
                setTimeout(function () {
                    $.ajax({
                        method: 'post',
                        url: $deleteButton.attr('href'),
                        data: {id: $deleteButton.data('id')},
                        dataType: 'json',
                        success: function(result){
                            swal({
                                title: '', 
                                text: result.message,
                                type: result.status
                                }, function() {
                                    location.reload();
                            });
                        }
                    });
                }, 1000);
        });
    });
}

// Modifier un rôle
function change_role(url) {

    $('body').on('change', 'select.roleChange', function(e){
        e.preventDefault();

        var $roleChange = $(this);

        $.ajax({
            method: 'post',
            url: url,
            data: {user_id: $roleChange.data('id'), user_role: $roleChange.find(':selected').val()},
            dataType: 'json',
            success: function(result){
                switch (result.status) {
                    case 'error':
                        swal('', result.message, result.status);
                        location.reload();
                        break;
                    
                    case 'success':
                        $roleChange.parent().addClass('has-success has-feedback');
                        break;
                }
            }
        });
    });
}
